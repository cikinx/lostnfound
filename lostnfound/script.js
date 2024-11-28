// JavaScript to toggle between Sign Up and Sign In forms
const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signUpForm = document.getElementById('signUp');
const signInForm = document.getElementById('signIn');

// Show Sign Up Form, Hide Sign In Form
signUpButton.addEventListener('click', function() {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});

// Show Sign In Form, Hide Sign Up Form
signInButton.addEventListener('click', function() {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});
