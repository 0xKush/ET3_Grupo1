<form action="install.php" method="POST">
    <p>Mysql Root User: <input type="text" name="user" /></p>
    <p>Mysql Root Password:  <input type="password" name="passwd" /></p>
    <p><input type="submit" name="submit" value="submit" /></p>
</form>

<?php
if (isset($_POST["submit"])){

    $mysqlUserName = $_POST["user"];
    $mysqlPasswd = $_POST["passwd"];
    $dbFile = "ET3Grupo1.sql";
    $command='mysql -u' .$mysqlUserName .' -p' .$mysqlPasswd . ' < ' .$dbFile;
    exec($command,$output=array(),$worked);
    switch($worked){
	case 0:
            echo 'Import file <b>' .$dbFile .'</b> successfully imported to database<br />';
            echo 'Database user created: ET3Grupo1 with password ET3Grupo1<br />';
            echo 'Test users created: admin with password admin, also name with password name for other users<br />';
            echo '<a href="index.php">Proceed to Website</a><br />';
            break;
	case 1:
            echo 'There was an error during import: User already Exists or You insert bad credentials<br /><br />';
            echo 'Database user created: moovett with password moovett<br /><br />';
            echo 'Website user admin created: admin with password admin<br /><br />';
            echo '<a href="index.php">Check if credentials are ok and Proceed to Website</a>';
            break;
    }
}
?>
