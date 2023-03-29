<?php
// Include config file
include"config.php";
 
// Define variables and initialize with empty values
$name = $info = $math = "";
 
// return the data to modify
if(isset($_POST["id"]) && !empty($_POST["id"])){

    // Get hidden input value
    $id = $_POST["id"];

    $name = $_POST['fname'];
    $info = $_POST['info'];
    $math = $_POST['math'];

    if($math < 0 || $math > 20  || $info <0 || $info >20 ){
        echo "Invalid inputs!";
    }
    
    else{
        // Prepare an update statement
        $sql = "UPDATE Notes SET Nom=:Nom, Info=:Info, Math=:Math WHERE ID_note=:ID_note";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Nom", $input_name);
            $stmt->bindParam(":Info", $input_info);
            $stmt->bindParam(":Math", $input_math);
            $stmt->bindParam(":ID_note",$input_id);
            
            // Set parameters
            $input_name = $name;
            $input_info = $info;
            $input_math = $math;
            $input_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: read.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
} 
else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // Get parameter
        $id =  $_GET["id"];
        
        // select statement
        $sql = "SELECT * FROM Notes WHERE ID_note = :ID_note";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables
            $stmt->bindParam(":ID_note",$input_id);
            
            // Set parameters
            $input_id = $id;
            
            // execute statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                   
                    $name = $row["Nom"];
                    $info = $row["Info"];
                    $math = $row["Math"];
                } else{
                    // send an error message
                    echo "Sorry, you've made an invalid request.";
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again.";
            }
        }
        
        // Close statement
        unset($stmt);
        
        // Close connection
        unset($pdo);
    }  else{
        // error!!!
        echo "Sorry, you've made an invalid request.";
        exit();
    }
}
?>
 
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
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="validateForm()"> 
                    <span>Full name</span>
                    <article>       
                        <div>
                            <input type="text" name="fname" id="fname" placeholder="ACH-CHATIBI AHMED" onchange="validateName(fname)" value="<?php echo $name; ?>">
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
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <button type="submit" name="submit" class="val">SUBMIT</button>
                            <button type="reset" name="reset" class="Ann">RESET</button>
                        </div>
                    </article>
                </form>
            </div>
        </section>
    </body>
</html>