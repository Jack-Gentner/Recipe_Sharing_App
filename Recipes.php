<html> 
    <head>

    <?php
    session_start();

    if (isset($_REQUEST["logout"])){
        session_unset();
        header('Location: /Dishcovery/Login.php');
    }

    ?>

        <link rel="stylesheet" href="Styles.css?v=<?php echo time(); ?>">     
        <title> Recipes </title>
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
                <li> <a href="Recipes.php"> Recipes </a> </li>
            </ul>
        </div>


        <?php
            $conn = new mysqli("localhost", "dish", "VMvsSM)naG(O@AQ)", "dish-covery");

            if ($conn->connect_error) {
                echo "Connection error";
            }
            else {
            $sql = 'SELECT UserEmail, RecipeName, Descriptions, Directions, Ingredients FROM recipes order by UserEmail';
            $result = $conn->query($sql);
            $conn->close();
            }

        ?>

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
    </body>
</html> 