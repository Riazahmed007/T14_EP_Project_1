from flask import Blueprint, render_template, redirect, url_for, request, flash, abort
from flask_login import login_required, current_user
from flask_wtf import FlaskForm
from website import db
from wtforms import StringField, SubmitField, TextAreaField
from wtforms.validators import DataRequired
from wtforms_sqlalchemy.fields import QuerySelectField  # Import QuerySelectField from wtforms.ext.sqlalchemy
from website.models import Role, User

# Define the blueprint: 'admin', set
admin = Blueprint('admin', __name__)

# Define the Role  and assign form
class RoleForm(FlaskForm):
    name = StringField('Name', validators=[DataRequired()])
    description = TextAreaField('Description', validators=[DataRequired()])
    submit = SubmitField('Submit')

class UserAssignForm(FlaskForm):
    role = QuerySelectField(query_factory=lambda: Role.query.all(), get_label="name")
    submit = SubmitField('Submit')


def check_admin():
    # prevent non-admins from accessing the page
    if not current_user.is_admin:
        abort(403)

@admin.route('/roles', methods=['GET', 'POST'])
@login_required
def list_roles():
    check_admin()
    "List all roles"

    roles = Role.query.all()

    return render_template('admin/roles/roles.html', roles=roles, title="Roles")

@admin.route('/roles/add', methods=['GET', 'POST'])
@login_required
def add_role():
    check_admin()
    "Add a role to the database"

    add_role = True

    form = RoleForm()
    if form.validate_on_submit():
        role = Role(name=form.name.data, description=form.description.data)

        try:
            # add role to the database
            db.session.add(role)
            db.session.commit()
            flash('You have successfully added a new role.')
        except:
            # in case role name already exists
            flash('Error: role name already exists.')

        # redirect to the roles page
        return redirect(url_for('admin.list_roles'))

    # load role template
    return render_template('admin/roles/role.html', add_role=add_role, form=form, title="Add Role")

@admin.route('/roles/edit/<int:id>', methods=['GET', 'POST'])
@login_required
def edit_role(id):
    check_admin()
    "Edit a role"

    add_role = False

    role = Role.query.get_or_404(id)
    form = RoleForm(obj=role)
    if form.validate_on_submit():
        role.name = form.name.data
        role.description = form.description.data
        db.session.commit()
        flash('You have successfully edited the role.')

        # redirect to the roles page
        return redirect(url_for('admin.list_roles'))

    form.description.data = role.description
    form.name.data = role.name
    return render_template('admin/roles/role.html', add_role=add_role, form=form, title="Edit Role")

@admin.route('/roles/delete/<int:id>', methods=['GET', 'POST'])
@login_required
def delete_role(id):
    check_admin()
    "Delete a role from the database"

    role = Role.query.get_or_404(id)
    db.session.delete(role)
    db.session.commit()
    flash('You have successfully deleted the role.')

    # redirect to the roles page
    return redirect(url_for('admin.list_roles'))

@admin.route('/users')
@login_required
def list_users():
    check_admin()
    "List all users"

    check_admin()

    users = User.query.all()
    return render_template('admin/users/users.html', users=users, title="Users")

@admin.route('/users/assign/<int:id>', methods=['GET', 'POST'])
@login_required
def assign_user(id):
    check_admin()
    "Assign a role to an user"

    check_admin()

    user = User.query.get_or_404(id)

    # prevent admin from being assigned a role
    if user.is_admin:
        abort(403)

    form = UserAssignForm(obj=user)
    if form.validate_on_submit():
        user.role = form.role.data
        db.session.add(user)
        db.session.commit()
        flash('You have successfully assigned a role.')

        # redirect to the roles page
        return redirect(url_for('admin.list_users'))

    return render_template('admin/users/user.html', user=user, form=form, title="Assign User")

@admin.route('/users/delete/<int:id>', methods=['GET', 'POST'])
@login_required
def delete_user(id):
    check_admin()
    "Delete a user from the database"

    check_admin()

    user = User.query.get_or_404(id)

    # prevent admin from being deleted
    if user.is_admin:
        abort(403)
    db.session.delete(user)
    db.session.commit()
    flash('You have successfully deleted the user.')

    # redirect to the roles page
    return redirect(url_for('admin.list_users'))