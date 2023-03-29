<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOG IN</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css"> 
        <link rel="stylesheet" type="text/css" href="css_Externalfile.css"/>
        <script type="text/javascript" src="jsExternalFile.js"></script>
    </head>
    <body id="login_index">
        <section class="sec">
            <div class="login">
                <h1>LOG IN</h1>
                <p>Need an account?<a href="">SIGN UP</a></p>
                    <?php
                       include("config.php");
                       session_start();
                      
                       if($_SERVER["REQUEST_METHOD"] == "POST") {
                         
                            //Identifiant et Password saisies dans le formulaire
                            
                            $user = $_POST['user'];
                            $password = $_POST['password'];
    
                            //Selectioner Identifiant et Password de la base de donnée 
                            
                            $sql = "SELECT Id FROM users WHERE Identif = '$user' and Pass = '$password'";
                            $result = $pdo->query($sql);
                        //   if (!$result) {
                        //     printf("Error: %s\n", mysqli_error($conn));
                        //     exit();// }
                            $row = $result->fetch();
                            // if (!$row) {
                            //         printf("<p id='error'>Invalid login: %s\n", mysqli_error($conn)."</p>");
                            //         exit(); }
                            $count = $result->rowCount();
                            
                            // If result matched $user and $password, table row must be 1 row
                            
                            if($count == 1) {
                                $_SESSION['login_user'] = $user;
                                header("location: read.php");
                            }
                            else {
                                echo "<p id='error'>Invalid Login!</p> <br>";
                            }

                            unset($pdo);
                        }
                    ?>
                <form action="" method="POST" onsubmit="validateForm()">
                    <article>
                        <img src="fi-rr-user.svg" alt="user">
                        <input type="text" name="user" id="user" placeholder="0123456789" onchange="validateIdentif()">
                    </article>
                        <?php
                            if(isset($_POST['login'])) {
                                if($_POST['user'] == "")
                                    echo "<span id='error'>The userID is required!</span>";
                            }
                        ?>
                    <span id="identifmg">It must contains only numbers.</span>
                    
                    <article>
                        <img src="fi-rr-password.svg" alt="password">
                        <input type="password" name="password" id="password" placeholder="********" onchange="validateKey()">
                    </article>
                        <?php 
                            if(isset($_POST['login'])) {
                                if($_POST['password'] == "")
                                    echo "<span id='error'>The password is required!</span>";
                            }
                        ?>
                    <span id="keymg">It must contains at least 8 caracters.</span>
                        
                    <article>
                        <button type="submit" name="login">SUBMIT</button>
                    </article>
                </form>
            </div>
        </section>
    </body>
</html>