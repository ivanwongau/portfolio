<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<h2>Join US</h2>
<h2> Personal information</h2>


<div class="container">
    <label for="name"><b>Your Name</b></label>
    <input type="text" placeholder="First name" name="name" required>
    <input type="text" placeholder="Last name" name="name" required>

    <label for="psw"><b>Phone</b></label>
    <input type="password" placeholder="Enter Phone number pls" name="psw" required>


    <label for="psw"><b>your role</b></label>


    <form action="/action_page.php">
        <input type="checkbox" id="role1" name="role1" value="Manager">
        <label for="role1"> Manager</label><br>
        <input type="checkbox" id="role2" name="role2" value="Owner">
        <label for="role2"> Owner</label><br>
        <input type="checkbox" id="role3" name="role3" value="Inspector">
        <label for="role3"> Inspector</label><br><br>

</div>



<button type="submit">NEXT--></button>


<div class="container" style="background-color:#f1f1f1">
    <span class="psw">Don't have an account? <a href="#">Log in</a></span>



</div>
</form>

</body>
</html>
