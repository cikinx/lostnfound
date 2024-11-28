<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    </head>
<body>
    <!-- Sign Up Container -->
  

    <!-- Sign In Container -->
    <div class="container" id="signIn"> <!-- Visible by default -->
        <h1 class="form-title">Admin Log In</h1>
        <form method="post" action="mregister.php">
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
                <a href="mforgot_password_process.php">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
     
    </div>
   
    <script src="script.js"></script>

    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins",sans-serif;
        }
        body{
            background-color: #B9E5E8;
            background:linear-gradient(to right, #e2e2e2, #c9d6ff);
        }
        .container
        {
            background: #fff;
            width: 450px;
            padding: 1.5rem;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0,0,1,0.9);
        }
        form{
            margin: 0 2rem;
        }
        .form-title{
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 1.3rem;
            margin-bottom: 0.4rem;
        }
        input{
            color: inherit;
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #757575;
            padding-left: 1.5rem;
            font-size: 15px;
        }
        .input-group
        {
            padding: 1% 0;
            position: relative;
        }
        .input-group i{
            position: absolute;
            color: black;
        }
        input:focus
        {
            background-color: transparent;
            outline: transparent;  
            border-bottom: 2px solid hsl(327, 90%, 28%);  
        }
        input::placeholder
        {
            color: transparent;
        }
        label
        {
            color: #757575;
            position: relative;
            left: 1.2em;
            top: -1.3em;
            cursor: auto;
            transition: 0.3s ease all;
        }
        input:focus~label,input:not(:placeholder-shown)~label
        {
            top: -3em;
            color: hsl(327, 90%, 28%);
            font-size: 15px;
        }
        .recover{
            text-align: right;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .recover a{
            text-decoration: none;
            color: rgb(125, 125, 235);
        }
        .recover a:hover{
            color: blue;
            text-decoration: underline;
        }
        .btn
        {
            font-size: 1.1rem;
            padding: 8px 0;
            border-radius: 5px;
            outline: none;
            border: none;
            width: 100%;
            background: rgb(125, 125, 235);
            color: white;
            cursor: pointer;
            transition: 0.9s;
        }
        .btn:hover{
            background: #07001f;
        }
        .or{
            font-size: 1.1rem;
            margin-top: 0.5rem;
            text-align: center;
        }
        .icons
        {
            text-align: center;
        }
        .icons i
        {
            color: rgb(125, 125, 235);
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            border: 2px solid #dfe9f5;
            margin: 0 15px;
            transition: 1s;
        }
        .icons i:hover{
            background: #07001f;
            font-size: 1.6rem;
            border: 2px solid rgb(125, 125, 235);
        }
        .links
        {
            display: flex;
            justify-content: space-around;
            padding: 0 4rem;
            margin-top: 0.9rem;
            font-weight: bold;
        }
        button{
            color: rgb(125, 125, 235);
            border: none;
            background-color: transparent;
            font-size: 1rem;
            font-weight: bold;
        }
        button:hover
        {
            text-decoration: underline;
            color: blue;
        }
        /* Homepage Button Styling */
        .home-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #8000ff; /* Matching the theme color */
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 1000;
            text-decoration: none;
        }

        .home-button:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
            background-color: #5a00cc;
        }

    </style>
     <a href="index.html" class="home-button">
    <i class="fas fa-home"></i>
    </a>
</body>
   
</html>
