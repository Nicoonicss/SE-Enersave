
const registrationForm = document.querySelector('form');

// Function to handle form submission and validation
function validateForm(event) {
    // 1. Prevent the default form submission for now
    event.preventDefault();

    // 2. Get the values from the password and email fields
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;
    const email = document.getElementById('email').value;
    const email2 = document.getElementById('email2').value;

    let isValid = true;

    // 3. Check if passwords match
    if (password !== password2) {
        alert("Error: Passwords do not match!");
        // A common practice is to clear the password fields on error
        document.getElementById('password').value = '';
        document.getElementById('password2').value = '';
        isValid = false;
    }

    // 4. Check if emails match
    if (email !== email2) {
        alert("Error: Emails do not match!");
        // A common practice is to clear the confirm email field on error
        document.getElementById('email2').value = '';
        isValid = false;
    }

    // 5. If all checks pass, you can submit the form
    if (isValid) {
        // Here you would typically perform an AJAX submission or 
        // use event.target.submit() to send the form data to the server.
        alert("Registration successful! (Form data would now be sent to the server.)");
        
        // Uncomment the line below to allow the form to actually submit to its action URL
        // event.target.submit(); 
    }
}

// Add the event listener to the form element
// We listen for the 'submit' event.
registrationForm.addEventListener('submit', validateForm);