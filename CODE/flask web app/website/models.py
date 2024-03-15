from website import db
from flask_login import UserMixin
from datetime import datetime
from werkzeug.security import generate_password_hash, check_password_hash




class User (UserMixin, db.Model):
    "create user table in the database"

    id = db.Column(db.Integer, primary_key=True)
    first_name = db.Column(db.String(100), unique=True)
    last_name = db.Column(db.String(100), unique=True)
    staffNO = db.Column(db.Integer, unique=True)
    email = db.Column(db.String(100), unique=True)
    Rank = db.Column(db.String(8))
    password = db.Column(db.String(100))
    role_id = db.Column(db.Integer, db.ForeignKey('role.id'))
    is_admin = db.Column(db.Boolean, default=False)
    is_supervisor = db.Column(db.Boolean, default=False)

    @property
    def password(self, password):
        
        # set password to a hashed password
        self.password_hash = generate_password_hash(password)

    def verify_password(self, password):
        # check if hashed password matches actual password
        return check_password_hash(self.password, password)
    
    def __repr__(self):
        return '<User: {}>'.format(self.username)
    
    @password.setter
    def password(self, password):
        self.password = generate_password_hash(password)

    def __repr__(self):
        return '<User: {}>'.format(self.first_name)


# pragma: no cover

class Role(db.Model):
    "create role table in the database"

    __tablename__ = 'role'

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), unique=True)
    description = db.Column(db.String(255))
    users = db.relationship('User', backref='role', lazy=True)

    def __repr__(self):
        return '<Role: {}>'.format(self.name)

# pragma: no cover

class Task(db.Model):
    "create task table in the database"

    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(100), unique=True)
    description = db.Column(db.String(255))
    priority = db.Column(db.String(8))
    assignee_id = db.Column(db.Integer, db.ForeignKey('user.id'))
    assignee = db.relationship('User', backref='task', lazy=True)
    date_created = db.Column(db.DateTime, default=datetime.utcnow)

    def __repr__(self):
        return '<Task: {}>'.format(self.title)
    
