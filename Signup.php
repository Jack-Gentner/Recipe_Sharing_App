<!DOCTYPE html>
    <?php session_start() 
    ?>
<html> 
    <head>
        <title> Sign up </title>

            <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">

        <script> 
            window.addEventListener("load", function(){
                let signupForm = document.forms.signup
                signupForm.addEventListener("submit", function(event){

                if (singupForm.pass1.value.length < 8) {
                    event.preventDefault();
                    window.alert("Invalid password")
                }
                if (signupForm.pass1.value !== signupForm.pass2.value){
                    event.preventDefault();
                    window.alert("Passwords do not match")
                }

                });
            });
            
        </script>
        
        <style>  
            body{
                background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/emojicollage-tess-png-1532368373.png);
            }

        </style>

    </head>

    <body>
        <div id="centeringdiv">
            <div id="LoginDiv">
                <form name="signup" method="post" enctype="multipart/form-data"> 
                <h1> Dish-covery </h1> <br> 
                Email: <input id="email" name="email" type="email"><p></p> <br>
                Password: <input id="pass1" name="pass1" type="password"> <p></p> 
                Re-enter Password: <input id="pass2" name="pass2" type="password"> <p></p>
                <button type="submit"> Sign up </a></button>
                <button type="button"> <a href="Login.php"> Go to Login </a> </button>
                </form>
            </div>
        </div>
        <?php

            function is_data_valid() {
                if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                    return false;
                }

                if (empty($_REQUEST["email"]) || empty($_REQUEST["pass1"]) || empty($_REQUEST["pass2"])) {
                    return false;
                }

                if (strlen($_REQUEST["pass1"]) < 8) {
                    return false;   
                }

                if ($_REQUEST["pass1"] !== $_REQUEST["pass2"]) {
                    return false;   
                }

                return true;
            }

        $conn = new mysqli("localhost", "dish", "VMvsSM)naG(O@AQ)", "dish-covery");

        if ($conn->connect_error) {
            echo "Connection error";
            
        }
        else if(is_data_valid()) {
            $email = $_REQUEST["email"];
            $hash = password_hash($_REQUEST["pass1"], PASSWORD_DEFAULT);
        
            $stmt = $conn->prepare("INSERT INTO user (Email, Pass) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hash);
            $stmt->execute();
            $stmt->close();

            $_SESSION["email"] = $_REQUEST["email"];
            $_SESSION["hash"] = $hash;

            header('Location: /Dishcovery/Home.php');
        }
        else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            ?>
            <p> Couldn't create an account. Please try agian. </p>
        
        <?php
        }
        ?>

    </body>
</html>