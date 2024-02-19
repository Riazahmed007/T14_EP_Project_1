from flask import Flask, render_template, request, redirect, url_for, jsonify
from flask_mysqldb import MySQL
import bcrypt

app = Flask(__name__)

# MySQL Configuration
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'username'
app.config['MYSQL_PASSWORD'] = 'password'
app.config['MYSQL_DB'] = 'dbname'

mysql = MySQL(app)

# Route for login
@app.route('/login', methods=['POST'])
def login():
    data = request.json
    username = data.get('username')
    password = data.get('password')

    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM Users WHERE Username = %s", (username,))
    user = cur.fetchone()
    cur.close()

    if user and bcrypt.checkpw(password.encode('utf-8'), user['Password'].encode('utf-8')):
        return jsonify({'success': True})
    else:
        return jsonify({'success': False})

# Other routes...

if __name__ == '__main__':
    app.run(debug=True)
