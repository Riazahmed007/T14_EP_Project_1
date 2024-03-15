from flask import Flask, render_template
from flask_sqlalchemy import SQLAlchemy
from os import path
from flask_login import LoginManager
import os
from flask_mail import Mail
from flask_bootstrap import Bootstrap
from flask_migrate import Migrate
db= SQLAlchemy()
DB_NAME = "database.db"

mail = Mail()

def create_app():
    app = Flask(__name__)
    app.config['SECRET_KEY'] = 'mysecretkey'
    app.config['SQLALCHEMY_DATABASE_URI'] = f'sqlite:///{DB_NAME}'

    
    mail.init_app(app)
    Bootstrap(app)
    db.init_app(app)

    migrate = Migrate(app, db)

    # Registering Blueprints   
    from .views import views
    from .auth import auth
    from .supervisor import supervisor
    from .home import home
    from .admin import admin
    



    app.register_blueprint(views, url_prefix='/')
    app.register_blueprint(auth, url_prefix='/')
    app.register_blueprint(supervisor, url_prefix='/supervisor')
    app.register_blueprint(home, url_prefix='/')
    app.register_blueprint(admin, url_prefix='/admin')

    
    from website.models import User, Role, Task



    with app.app_context():
        db.create_all()
    
    # flask-login
    login_manager = LoginManager()
    login_manager.login_message = "Unauthorized User. Please Login."
    login_manager.login_view = 'auth.login'

    
    @login_manager.user_loader
    def load_user(id):
        return User.query.get(int(id))
    
    @app.errorhandler(403)
    def forbidden(e):
        return render_template('errors/403.html'), 403
    
    @app.errorhandler(404)
    def page_not_found(e):
        return render_template('errors/404.html'), 404
    
    @app.errorhandler(500)
    def server_error(e):
        return render_template('errors/500.html'), 500

    

    return app

def create_db(app):
    if not path.exists('website/' + DB_NAME):
        with app.app_context():
            db.create_all()
        print("Database Created")