from flask import Blueprint, render_template, abort
from flask_login import login_required, current_user

from website import db
#Define the blueprint: 'home', set
home = Blueprint('home', __name__)

@home.route('/')
def homepage():
    """
    Render the homepage template on the / route
    """
    return render_template('home/index.html', title="Welcome")

@home.route('/dashboard')
@login_required
def dashboard():
    """
    Render the dashboard template on the /dashboard route
    """
    return render_template('home/dashboard.html', title="Dashboard")

@home.route('/admin/dashboard')
@login_required
def admin_dashboard():
    """
    Render the admin dashboard template on the /admin/dashboard route
    """
    # prevent non-admins from accessing the page
    if not current_user.is_admin:
        abort(403)

    return render_template('admin/dashboard.html', title="Dashboard")

@home.route('/supervisor/dashboard')
@login_required
def supervisor_dashboard():
    """
    Render the supervisor dashboard template on the /supervisor/dashboard route
    """
    # prevent non-supervisors from accessing the page
    if not current_user.is_supervisor:
        abort(403)

    return render_template('supervisor/dashboard.html', title="Dashboard")

@home.route('/employee/dashboard')
@login_required
def employee_dashboard():
    """
    Render the employee dashboard template on the /employee/dashboard route
    """
    if not current_user.is_employee:
        abort(403)
    return render_template('employee/dashboard.html', title="Dashboard")