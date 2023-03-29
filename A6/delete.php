<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    include "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM Notes WHERE ID_note = :ID_note";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables
        $stmt->bindParam(":ID_note", $input_id);
        
        // Set parameters
        $input_id = $_POST["id"];
        
        // execute statement
        if($stmt->execute()){
            //deleted successfully.
            header("location: read.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // id doesn't exist
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
    <div class="wrapper">
        <div class="">
            <h2 class="">Confirm Your Action</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert">
                    <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
                    <p>Are you sure you want to delete this record?</p>
                    <p>
                        <input type="submit" value="Yes" class="danger">
                        <a href="index.php" class="no">No</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <style>
        .wrapper{
            margin: 0 auto;
            padding: 140px;
            text-align: center;
        }
        .wrapper h2{
            padding: 5px;
        }
        p{
            padding: 10px;
        }
        .danger{
            background: none;
            border: 1px solid green;
            color: green;
            padding: 5px;
            margin-right: 5px;
        }
        .no{
            text-decoration: none;
            color: red;
        }
    </style>
</body>
</html>