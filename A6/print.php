<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty($_GET["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM Notes WHERE ID_note = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $_GET["id"];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["Nom"];
                $info = $row["Info"];
                $math = $row["Math"];

                $moy = ($row['Info'] + $row['Math'])/2;
                if($moy < 10) $ment = "Adjourned";
                else $ment = "Admitted";

                function mention($note){
                    $m = "";
                    if($note < 10) $m = "NV";
                    else $m = "V";
            
                    echo $m;
                }
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                echo "Sorry, you've made an invalid request.";
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    echo "Sorry, you've made an invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PRINT RECORD</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css"> 
        <link rel="stylesheet" type="text/css" href="css_Externalfile1.css"/>
        <script type="text/javascript" src="jsExternalFile.js"></script>
    </head>
    <body>
        <form action="">
            <div>
                <?php echo "Name: "."<span>".$row['Nom']."</span>"; ?>
                <div class="t">
                    <table border="1">
                        <tr class="head">
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Result</th>
                        </tr>
                        <tr>
                            <td>Comp. Sciences</td>
                            <td><p><b><?php echo $row["Info"]; ?></b></p></td>
                            <td><p><b><?php mention($row['Info']); ?></b></p></td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td><p><b><?php echo $row["Math"]; ?></b></p></td>
                            <td><p><b><?php mention($row['Math']); ?></b></p></td>
                        </tr>
                    </table>
                </div>

                <?php echo "Final Result: "."<span>".$moy."</span><br>"; ?>
                <?php echo "<span>".$ment."</span>."; ?>

            </div>
            <br>
            <br>
            <a href="file.pdf">Télécharger !</a> 

            <p><a href="read.php" class="logout">Back</a></p>
        </form>
        <style>
            <?php 
            
            ?>
            form{
                padding: 140px;
                text-align: center;
            }
            .t{
                display: grid;
                justify-content: center;
            }
            table{
                width: 600px;
            }
            table td, th{
                padding: 7px;
                font-weight: normal;
            }
            tr.head{
                background-color: cornflowerblue;
            }
            span{
                font-weight: bold;
            }
        </style>
    </body>
</html>