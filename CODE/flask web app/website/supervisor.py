from flask import Blueprint, render_template, redirect, url_for, request, flash, abort
from flask_wtf import FlaskForm
from flask_login import current_user, login_required
from wtforms import StringField, SubmitField, TextAreaField, SelectField, IntegerField
from wtforms.validators import DataRequired, Length
from wtforms_sqlalchemy.fields import QuerySelectField
from flask_mail import Message
from wtforms.fields import SelectMultipleField

from website.models import User, Task
from website import db
from website import mail

# Define the blueprint: 'supervisor', set
supervisor = Blueprint('supervisor', __name__)

# Define the Task and assign form
class TaskForm(FlaskForm):
    title = StringField('Title', validators=[DataRequired(), Length(min=2, max=100)])
    description = TextAreaField('Description', validators=[DataRequired()])
    assignee = QuerySelectField(query_factory=lambda: User.query.all(), get_label="first_name")
    priority = SelectField('Priority', choices=[('Low', 'Low'), ('Medium', 'Medium'), ('High', 'High')])
    submit = SubmitField('Submit')

class UpdateTaskForm(FlaskForm):
    title = StringField('Title', validators=[DataRequired(), Length(min=2, max=100)])
    description = TextAreaField('Description', validators=[DataRequired()])
    assignee = QuerySelectField(query_factory=lambda: User.query.all(), get_label="first_name")
    priority = SelectField('Priority', choices=[('Low', 'Low'), ('Medium', 'Medium'), ('High', 'High')])
    submit = SubmitField('Update')
    
class TaskAssignForm(FlaskForm):
    task_id = StringField('Task ID', validators=[DataRequired()])
    assignees = SelectMultipleField('Assignees', coerce=int)
    submit = SubmitField('Assign')

    class EmailNotification:
        @staticmethod
        def send_notification(user_email, task_title):
            msg = Message('Task Assignment', recipients=[user_email])
            msg.body = f"You have been assigned a new task: {task_title}"
            mail.send(msg)

def check_supervisor():
    # prevent non-supervisor from accessing the page
    if not current_user.is_supervisor:
        abort(403)

@supervisor.route('/tasks', methods=['GET', 'POST'])
@login_required
def create_task():
    check_supervisor()
    "Create a task"
    form = TaskForm()
    if form.validate_on_submit():
        task = Task(title=form.title.data,
                    description=form.description.data,
                    priority=form.priority.data,
                    assignee=form.assignee.data)
        db.session.add(task)
        db.session.commit()
        flash('You have successfully added a new task.')
        return redirect(url_for('supervisor.create_task'))
    return render_template('supervisor/tasks/task.html', form=form, title="Create Task")

@supervisor.route('/tasks/edit/<int:id>', methods=['GET', 'POST'])
@login_required
def assign_task():
    check_supervisor()
    "Assign a task to a user"
    form = TaskAssignForm()
    users = User.query.filter_by(is_admin=False, is_supervisor=False).all()
    form.assignees.choices = [(user.id, user.username) for user in users]
    if form.validate_on_submit():
        task_id = form.task_id.data
        task = Task.query.get(task_id)
        if task is None:
            flash('Invalid task ID.')
            return redirect(url_for('supervisor.list_tasks'))
        for assignee_id in form.assignees.data:
            user = User.query.get(assignee_id)
            if user is None:
                flash(f'Invalid user ID: {assignee_id}.')
                continue  # skip this assignee and continue with the next one
            task.assignee = user
            db.session.add(task)
        db.session.commit()
        flash('Task assigned successfully.')
        return redirect(url_for('supervisor.list_tasks'))
    return render_template('supervisor/tasks/assign_task.html', form=form, title="Assign Task")

@supervisor.route('/tasks/edit/<int:id>', methods=['GET', 'POST'])
@login_required
def update_task(id):
    check_supervisor()
    "Edit a task"
    task = Task.query.get_or_404(id)
    form = UpdateTaskForm(obj=task)
    if form.validate_on_submit():
        task.title = form.title.data
        task.description = form.description.data
        task.priority = form.priority.data
        task.assignee = form.assignee.data
        db.session.commit()
        flash('You have successfully updated the task.')
        return redirect(url_for('supervisor.list_tasks'))
    form.title.data = task.title
    form.description.data = task.description
    form.priority.data = task.priority
    form.assignee.data = task.assignee
    return render_template('supervisor/tasks/task.html', form=form, title="Edit Task")

@supervisor.route('/tasks', methods=['GET', 'POST'])
@login_required
def list_tasks():
    check_supervisor()
    "List all tasks"
    tasks = Task.query.all()
    return render_template('supervisor/tasks/tasks.html', tasks=tasks, title="Tasks")

@supervisor.route('/tasks/<int:id>', methods=['GET', 'POST'])
@login_required
def search_task(id):
    check_supervisor()
    "Search for a task"
    task = Task.query.get_or_404(id)
    return render_template('supervisor/tasks/task.html', task=task, title="Task")

@supervisor.route('/tasks/delete/<int:id>', methods=['GET', 'POST'])
@login_required
def delete_task(id):
    check_supervisor()
    "Delete a task from the database"
    task = Task.query.get_or_404(id)
    db.session.delete(task)
    db.session.commit()
    flash('You have successfully deleted the task.')
    return redirect(url_for('supervisor.list_tasks'))