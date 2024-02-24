<!DOCTYPE html>
<?php 
    
?>
<html> 
    <head>
        <title> Login Page </title>

        <script> 

        </script>

            <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">        
        <style> 
            body{
                background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/emojicollage-tess-png-1532368373.png);
            } 

        </style>

    </head>

    <body>

        <div id="centeringdiv">   
            <div id="LoginDiv">
                <form name="login" method="post" enctype="multipart/form-data"> 
                <h1> Dish-covery </h1> <br> 
                Username: <input name="email" id="email" type="email"><br> <br>
                Password: <input name="pass1" id="pass1" type="password"> <br> <br>
                <button type="submit"> Login </a></button>
                <button> <a href="Signup.php"> Go to Sign up </a> </button> <!--- change to links and have <a> that looks like a button, w3c has examples and pre built ones-->
                </form>
            </div>
        </div>

    </body>
    <?php 

        function is_data_valid() {
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                return false;
            }

            if (empty($_REQUEST["email"]) || empty($_REQUEST["pass1"])) {
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

            $stmt = $conn->prepare("SELECT Email, Pass FROM User WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                $hash = $row["Pass"];

                if (password_verify($_REQUEST["pass1"], $hash)) {
                    session_start();
                    $_SESSION["email"] = $_REQUEST["email"];
                    $_SESSION["hash"] = $hash;
                    header("Location: /dishcovery/Home.php");
                } else {
                    echo "Login failed";
                }
            } else {
                echo "Login failed";
            }

            $stmt->close();
        }           else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "Bad form";
        }

    ?>
</html>