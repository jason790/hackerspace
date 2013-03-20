<?php
$hostname = "localhost";
$database = "hackerspace";
$username = "hackerspace";
$password = "123456";

$connect = mysql_connect($hostname, $username, $password)
or die('Could not connect: ' . mysql_error());

//Select The database
$bool = mysql_select_db($database, $connect);

if ($bool === False){
   print "can't find $database";
}


//--------------------------------------------------------------------------
if (isset($_GET['insert_members']))
{
	$insert_query = "INSERT INTO members (JoinDate, FirstName, LastName, MemberType, Email, Phone, Notes, Active) VALUES ('" . 
					$_GET['JoinDate']."','".$_GET['FirstName']."','".$_GET['LastName']."','".$_GET['MemberType']."','".$_GET['Email']."','".$_GET['Phone']."','".$_GET['Notes']."','".$_GET['Active']."')";
	
    $result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);  
    echo $result;
}

else if (isset($_GET['update_view']))
{
    echo "0;0;0;";
}

else if (isset($_GET['update_members']))
{
	$update_query = "UPDATE members SET 
	JoinDate='".$_GET['JoinDate']."',
	FirstName='".$_GET['FirstName']."',
	LastName='".$_GET['LastName']."',
	MemberType='".$_GET['MemberType']."',
	Email='".$_GET['Email']."',
	Phone='".$_GET['Phone']."',
	Notes='".$_GET['Notes']."',
	Active='".$_GET['Active']."'
	WHERE ID='".$_GET['ID']."'";
	
	$result = mysql_query($update_query) or die("SQL Error 1: " . $update_query ."---". mysql_error());

	mysql_close($connect);
}

else if (isset($_GET['delete_members']))
{
	$delete_query = "UPDATE  members SET deleted=1 WHERE ID='".$_GET['ID']."'";	
	$result = mysql_query($delete_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);
    echo $result;
}

else if (isset($_GET['get_members']))
{
	$query = "SELECT * FROM members WHERE deleted=0 ORDER BY ID DESC";

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$members[] = array(
			'ID' => $row['ID'], 
			'JoinDate' => $row['JoinDate'],
			'FirstName' => $row['FirstName'],
			'LastName' => $row['LastName'],
			'MemberType' => $row['MemberType'],
			'Email' => $row['email'],
			'Phone' => $row['Phone'],
			'Notes' => $row['Notes'],
			'Active' => $row['Active']
		  );
	}
	 
	echo json_encode($members);
}

?>