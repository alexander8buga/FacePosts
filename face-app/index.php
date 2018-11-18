<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <title>Face Posts</title>
    </head>
    <body>
        <div id="container">
            <header>
                <h1 id="indent"><span class="blue-text">Face</span> posts</h1>
            </header>
            <div class="row">
                <div class="col">
                    <form action="register.php" method="POST">
                        <section>
                            <h4 id="indent">Write your name</h4>
                            <p >Enter your name</p>
                            <input  type="text" name="name" >
                            <button class="btn" type="submit" >Post</button>
                        </section>
                    </form>
                </div>
                <div class="col">
                    <section>
                        <p>Fake posts:</p>
                        <?php
                        /* Attempt MySQL server connection. Assuming you are running MySQL
                        server with default setting (user 'root' with no password) */
                        try{
                            $connection = new PDO("mysql:host=localhost;dbname=MyDBTest", "root", "");
                            // Set the PDO error mode to exception
                            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch(PDOException $e){
                            die("ERROR: Could not connect. " . $e->getMessage());
                        }
                        //Get names from DB
                        try{
                            // Attempt select query execution
                            try{
                                $sql = "SELECT * FROM posts";  
                                $result = $connection->query($sql);
                                if($result->rowCount() > 0){
                                    echo "<table>";
                                        echo "<tr>";
                                            echo "<th>id</th>";
                                            echo "<th>name</th>";
                                        echo "</tr>";
                                    while($row = $result->fetch()){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    // Free result set
                                    unset($result);
                                } else{
                                    echo "No records matching your query were found.";
                                }
                            } catch(PDOException $e){
                                die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                            }
                            
                        } catch(PDOException $e){
                            die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
                        }
                            
                        // Close statement
                        unset($stmt);
                            
                        // Close connection
                        unset($connection);
                        ?>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>



