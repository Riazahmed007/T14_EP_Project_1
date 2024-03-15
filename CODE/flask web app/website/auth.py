
from flask import Blueprint, render_template, request, flash, redirect, url_for
from website.models import User
from website import db
from flask_login import login_user, login_required, logout_user, current_user
from flask_wtf import FlaskForm
from wtforms import PasswordField, StringField, SubmitField, ValidationError
from wtforms.validators import DataRequired, Email, EqualTo



#Define the blueprint: 'website', set its url prefix: app.url/website
auth = Blueprint('auth', __name__)

# Define the User registration form
class RegistrationForm(FlaskForm):
    """
    Form for users to create new account
    """
    email = StringField('Email', validators=[DataRequired(), Email()])
    first_name = StringField('First Name', validators=[DataRequired()])
    last_name = StringField('Last Name', validators=[DataRequired()])
    staffNO = StringField('Staff Number', validators=[DataRequired()])
    rank = StringField('Rank', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired(), EqualTo('confirm_password')])
    confirm_password = PasswordField('Confirm Password')
    submit = SubmitField('Register')

    def validate_conditoin(self, first_name, last_name, rank):
        if first_name == rank or last_name == rank:
            raise ValidationError('First Name, Last Name and Rank must be different')
        elif len(first_name) < 2:
            raise ValidationError('First Name is too short')
        elif len(last_name) < 2:
            raise ValidationError('Last Name is too short')
        elif len(rank) < 2:
            raise ValidationError('Rank is too short')
        
    def validate_password(self, field):
        if self.password.data != self.confirm_password.data:
            raise ValidationError('Passwords do not match')
        
class LoginForm(FlaskForm):
    """
    Form for users to login
    """
    login_id = StringField('Email or Staff Number', validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()])
    submit = SubmitField('Login')

class PasswordResetRequestForm(FlaskForm):
    """
    Form for users to request a password reset
    """
    email = StringField('Email', validators=[DataRequired(), Email()])
    submit = SubmitField('Reset Password')


@auth.route('/sign_up', methods=['GET', 'POST'])
def sign_up():
    '''Handle requests to the /register route'''

    form = RegistrationForm()

    if form.validate_on_submit():
            user = User(email=form.email.data,
                        first_name=form.first_name.data,
                        last_name=form.last_name.data,
                        staffNO=form.staffNO.data,
                        rank=form.rank.data,
                        password=form.password.data)
            # add user to the database
            db.session.add(user)
            db.session.commit()
            flash('You have successfully registered! You may now login.')

            # redirect to the login page
            return redirect(url_for('auth.login'))

    # load registration template    
    return render_template("auth/sign_up.html", form=form, title="Register" )

@auth.route('/login', methods=['GET', 'POST'])
def login():
    """
    Handle requests to the /login route
    Log a user in through the login form
    """
    form = LoginForm()
    if form.validate_on_submit():

        # check whether user exists in the database and whether
        # the password entered matches the password in the database
        user = User.query.filter_by(email=form.login_id.data).first()
        if user is not None and user.verify_password(form.password.data):
            # log user in
            login_user(user, remember=True)

            # redirect to the appropriate dashboard page after login
            if user.is_admin:
                return redirect(url_for('admin.dashboard'))
            elif user.is_supervisor:
                return redirect(url_for('supervisor.dashboard'))
            else:
                return redirect(url_for('employee.dashboard'))
            
            # if login details are incorrect
        else:
            flash('Invalid email or password.')

    # load login template
    return render_template('auth/login.html', form=form, title='Login')

@auth.route('/logout')
@login_required
def logout():
    """
    Handle requests to the /logout route
    Log a user out through the logout link
    """
    logout_user()
    flash('You have successfully been logged out.')

    # redirect to the login page
    return redirect(url_for('auth.login'))

@auth.route('/reset-password', methods=['GET', 'POST'])
def reset_password():
    """
    Handle requests to the /reset-password route
    Reset a user's password through the reset password form
    """
    form = PasswordResetRequestForm()
    if form.validate_on_submit():
        user = User.query.filter_by(email=form.email.data).first()
        if user:
            user.password = form.password.data
            db.session.commit()
            flash('You have successfully reset your password. You may now login.')

            # redirect to the login page
            return redirect(url_for('auth.login'))
        else:
            flash('Invalid email.')

    # load reset password template
    return render_template('auth/reset_password.html', form=form, title='Reset Password')