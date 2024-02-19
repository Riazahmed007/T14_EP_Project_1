// Login Form Submission
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Send login credentials to the server for authentication
    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/dashboard'; // Redirect to dashboard upon successful login
        } else {
            alert('Invalid username or password');
        }
    })
    .catch(error => console.error('Error:', error));
});

// Signup Form Submission
document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Send signup data to the server for registration
    fetch('/signup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/'; // Redirect to login page upon successful signup
        } else {
            alert('Signup failed. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
});
