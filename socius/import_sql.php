<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = mysqli_connect('sg2nlmysql35plsk.secureserver.net', 'web_admin', 'W3b@dm1n@DB', 'socius_contracktor');


$filename = 'db_contracktor.sql'; //How to Create SQL File Step : url:http://localhost/phpmyadmin->detabase select->table select->Export(In Upper Toolbar)->Go:DOWNLOAD .SQL FILE
$op_data = '';
$lines = file($filename);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
    {
        $conn->query($op_data);
        $op_data = '';
    }
}
echo "Table Created Inside " . $database . " Database.......";
// Close connection
?>