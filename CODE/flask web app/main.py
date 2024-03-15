from  website import create_app

app = create_app()
# Setting Entery Point
if __name__ == '__main__':
    app.run(debug=True)

 