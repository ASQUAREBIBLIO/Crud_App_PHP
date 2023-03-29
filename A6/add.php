
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VIEW</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css"> 
        <link rel="stylesheet" type="text/css" href="css_Externalfile1.css"/>
        <script type="text/javascript" src="jsExternalFile.js"></script>
    </head>
    <body>
        <header>
            <a href="logout.php" class="logout" name="logout">Log Out</a>
        </header>
        <section class="publish_work">
            <div class="publish_form">
                <h1>ADD NEW</h1>
                <?php
                    // Include config file
                    include("config.php");
                    
                    // Define variables and initialize with empty values
                    $name = $info = $math = "";
                    
                    // return the data when the form is submited
                    if(isset($_POST['submit'])){

                        session_start();
                        
                        $name = $_POST['fname'];
                        $info = $_POST['info'];
                        $math = $_POST['math'];

                        
                        if(empty($_POST['fname']) || empty($_POST['info']) || empty($_POST['math'])){
                            echo "<span id='error'>All the fields are required.</span>";
                        }
                        

                        elseif($math < 0 || $math > 20  || $info <0 || $info >20 ){
                            echo "<span id='error'>Invalid inputs!</span>";
                        }

                        else{
                            $sql = "INSERT INTO Notes (Nom, Info, Math) VALUES (:Nom, :Info, :Math)";
                    
                            if($stmt = $pdo->prepare($sql)){
                                // Bind variables to the prepared statement as parameters
                                $stmt->bindParam(":Nom", $input_name);
                                $stmt->bindParam(":Info", $input_info);
                                $stmt->bindParam(":Math", $input_math);
                        
                                /* Set the parameters values and execute
                                the statement again to insert another row */
                            
                                $input_name = $name;
                                $input_info = $info;
                                $input_math = $math;

                                // Attempt to execute the prepared statement
                                if($stmt->execute()){
                                    header("location: read.php");
                                    exit();
                                } 
                                else{
                                    echo "Oops! Something went wrong. Please try again later.";
                                }

                            }
                            
                            // Close statement
                            unset($stmt);
                            
                            // Close connection
                            unset($pdo);

                        }
                    }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="validateForm()"> 
                    <span>Name</span>
                    <article>       
                        <div>
                            <input type="text" name="fname" id="fname" placeholder="ACH-CHATIBI AHMED" onchange="validateName()" value="<?php echo $name; ?>">
                        </div>
                    </article>
                    <?php
                        if(isset($_POST['submit'])) {
                            if($_POST['fname'] == "")
                                echo "<span id='error'>The Full name is required!</span>";
                        }
                    ?>
                    <span id="identifmg">It must only contains letters.</span>

                    <span>Comp. Sciences</span> 
                    <article>       
                        <div>
                            <input type="text" name="info" id="info" placeholder="0" onchange="validateNote(info)" value="<?php echo $info; ?>">
                        </div>
                    </article>
                    <?php
                        if(isset($_POST['submit'])) {
                            if($_POST['info'] == "")
                                echo "<span id='error'>This field is required!</span>";
                        }
                    ?>
                    <span id="identifmg"></span>

                    <span>Mathematics</span> 
                    <article>       
                        <div>
                            <input type="text" name="math" id="math" placeholder="0" onchange="validateNote(math)" value="<?php echo $math; ?>">
                        </div>
                    </article>
                    <?php
                        if(isset($_POST['submit'])) {
                            if($_POST['math'] == "")
                                echo "<span id='error'>This field is required!</span>";
                        }
                    ?>
                    <span id="identifmg"></span>

                    <article class="btn">
                        <div>
                            <button type="submit" name="submit" class="val">SUBMIT</button>
                            <button type="reset" name="reset" class="Ann">RESET</button>
                        </div>
                    </article>
                </form>
            </div>
        </section>
    </body>
</html>