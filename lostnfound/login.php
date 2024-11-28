<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <!-- reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <!-- Sign Up Container -->
    <div class="container" id="signUp" style="display: none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fName">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="g-recaptcha" data-sitekey="6LfHs28qAAAAAPod4uFYZswlRT4_pqmsSsxxq5uH"></div> <!-- reCAPTCHA widget -->
            <br>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
       
        <div class="links">
            <p>Already have Account?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <!-- Sign In Container -->
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="emailSignIn" placeholder="Email" required>
                <label for="emailSignIn">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="passwordSignIn" placeholder="Password" required>
                <label for="passwordSignIn">Password</label>
            </div>
            <p class="recover">
            <a href="forgot_password_process.php">Recover Password</a>
            </p>
            <div class="g-recaptcha" data-sitekey="6LfHs28qAAAAAPod4uFYZswlRT4_pqmsSsxxq5uH"></div> <!-- reCAPTCHA widget -->
            <br>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        
        <div class="links">
            <p>Don't Have Account Yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
