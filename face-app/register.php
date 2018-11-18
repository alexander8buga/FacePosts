
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
 
// Attempt insert query execution
try{
    // Prepare an insert statement
    $sql = "INSERT INTO posts (name) VALUES (:name)";
    $stmt = $connection->prepare($sql);
    
    // Bind parameters to statement
    $stmt->bindParam(':name', $_REQUEST['name']);
    
    
    /* Execute  the statement to insert a row */
    $affectedRows = $stmt->execute();
    
    if ($affectedRows  > 0) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Name inserted successfully.')
            window.location.href='index.php'
            </SCRIPT>");
        exit();

    } else {
        echo ("Insertion failed");
    } 

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
unset($pdo);
?>