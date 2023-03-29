
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
        <div>
            <a href="logout.php" class="logout" name="logout">Log Out</a>
        </div>
    </header>
    <section class="publish_work">
        <div class="publish_form">
            <div class="header">
                <h2>
                    RECENTLY ADDED
                    <a href="add.php" class="add"><i class="fa fa-plus"></i> Add New</a>
                </h2>
            </div>
            <div class="result">
            <?php
                // Include config file
                include"config.php";
                    
                // Attempt select query execution
                $sql = "SELECT * FROM Notes";
                if($result = $pdo->query($sql)){
                    if($result->rowCount() > 0){
                        echo '<table>';
                            echo "<tr class='head'>";
                                echo "<th>#</th>";
                                echo "<th>Name</th>";
                                echo "<th>Comp. Sciences</th>";
                                echo "<th>Mathematics</th>";
                                echo "<th>AVG</th>";
                                echo "<th>Result</th>";
                                echo "<th>Action</th>";
                            echo "</tr>";
                            
                            while($row = $result->fetch()){
                                $moy = ($row['Info'] + $row['Math'])/2;
                                if($moy < 10) $ment = "Adjourned";
                                else $ment = "Admitted";
                                echo "<tr>";
                                    echo "<td>" . $row['ID_note'] . "</td>";
                                    echo "<td>" . $row['Nom'] . "</td>";
                                    echo "<td>" . $row['Info'] . "</td>";
                                    echo "<td>" . $row['Math'] . "</td>";
                                    echo "<td>" . $moy. "</td>";
                                    echo "<td>" . $ment . "</td>";
                                    echo "<td class='action'>";
                                        echo '<a class="up" href="update.php?id='. $row['ID_note'] .'" title="Update Record"><span class="fa fa-pen"></span></a>';
                                        echo '<a class="del" href="delete.php?id='. $row['ID_note'] .'" title="Delete Record"><span class="fa fa-trash"></span></a>';
                                        echo '<a class="pr" href="print.php?id='. $row['ID_note'] .'" title="Print Record"><span class="fa fa-print"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }                          
                        echo "</table>";
                        // Free result set
                        unset($result);
                    }
                    else{
                        echo '<div id="em"><em>No results.</em></div>';
                    }
                } 
                else{
                    echo "<span id='error'>Oops! Something went wrong. Please try again.</span>";
                }
 
                // Close connection
                unset($pdo);
            ?>
            </div>
            <style>
                *{
                    text-decoration: none;
                }
                #em{
                    margin: 50px 0;
                }
                td.action a{
                    color: #FFF;
                    margin-left: 4px;
                    padding: 7px;
                    border: none;
                }
                .up{
                    background-color: rgb(57, 70, 146);
                }
                .del{
                    background-color: rgb(128, 35, 35);
                }
                .pr{
                    background-color: rgb(187, 111, 12);
                }
            </style>
        </div>
    </section>
</body>
</html>