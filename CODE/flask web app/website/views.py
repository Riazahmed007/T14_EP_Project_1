from flask import Blueprint, render_template

#Define the blueprint: 'website', set its url prefix: app.url/website
views = Blueprint('views', __name__)

@views.route('/')
def home():
    return render_template("home.html")

