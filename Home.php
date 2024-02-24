<!DOCTYPE html>
<html> 

        <script> 
            window.addEventListener("load", function(){
                let Recipieform = document.forms.Recipes
                Recipeform.addEventListener("submit", function(event){

                if (empty('name')) {
                    event.preventDefault();
                    window.alert("Error, try again")
                }
                if (empty('Ingredients')) {
                    event.preventDefault();
                    window.alert("Error, try again")
                }
                if (empty('Descriptions')) {
                    event.preventDefault();
                    window.alert("Error, try again")
                }
                if (empty('Directions')) {
                    event.preventDefault();
                    window.alert("Error, try again")
                }

                });
            });
            
        </script>

    <?php
    session_start();

    if (isset($_REQUEST["logout"])){
        session_unset();
        header('Location: /Dishcovery/Login.php');
    }

    ?>
        <?php 
      
      $conn = new mysqli("localhost", "dish", "VMvsSM)naG(O@AQ)", "dish-covery");
  
      if ($conn->connect_error) {
          echo "Connection error";
      }
      else if (empty("name") || empty("Ingredients") || empty("Description") || empty("Directions")) {
          return false;
          echo "Error, try again";
      }
      else if (isset($_REQUEST["name"]) || isset($_REQUEST["Ingredients"]) || isset($_REQUEST["Description"]) || isset($_REQUEST["Directions"])){
      $description = $_REQUEST["Description"];
      $directions = $_REQUEST["Directions"];   
      $recipename = $_REQUEST["name"];
      $email = $_SESSION["email"];
      $ingredients = $_REQUEST['Ingredients'];
  
      $stmt = $conn->prepare("INSERT INTO recipes (UserEmail, RecipeName, Descriptions, Directions, Ingredients) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $email, $recipename, $description, $directions, $ingredients);
      $stmt->execute();
      $stmt->close();
  
      }


      $email = $_SESSION["email"];
      $sql = 'SELECT UserEmail, RecipeName, Descriptions, Directions, Ingredients FROM recipes Where UserEmail = "'.$email.'"';
      $result = $conn->query($sql);
      $conn->close();
      
      ?>
    <head>
        <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">
        <title> Home Page </title>
        <style>
            body{
                background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/emojicollage-tess-png-1532368373.png);
            }
        </style>
    </head>
    <body>
        
        <form>
            <input type="hidden" name="logout" value="1" />
            <button type="submit">Logout</button>
        </form>
        
        <div id="navBar">
            <ul>
                <li> <a href="Home.php"> My Page </a></li>
                <br>
                <li> <a href="Recipes.php"> Recipes </a> </li>
            </ul>
        </div>

    <div id="container">    
        <div id="form">
            <form name="Recipes" method="get"> 
                Recipe Name: <input type="text" name="name" id="name"> <p></p>
                Description: <input type="text" name="Description" id="Description"> <p></p>
                Ingredients: <input type="text" name="Ingredients" id="Ingredients"> <p></p>
                Directions: <input type="text" name="Directions" id="Directions"> <p></p>
                <button type="sumbit"> Submit </button>
            </form>
        </div>
    </div>

    <table id="uR">

    <tr> 
        <th> Author</th>
        <th> Recipe Name</th>
        <th> Description</th>
        <th> Directions</th>
        <th> Ingredients</th>
    </tr> 
    <?php   
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <td id="three"><?php echo $rows['UserEmail'];?></td>
                <td class="one"><?php echo $rows['RecipeName'];?></td>
                <td class="one"><?php echo $rows['Descriptions'];?></td>
                <td id="two"><?php echo $rows['Directions'];?></td>
                <td class="one"><?php echo $rows['Ingredients'];?></td>
            </tr>
            <?php
                }
             ?>

    </table>
    </body>
</html>