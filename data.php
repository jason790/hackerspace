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
//--------------------------------------------------------------------------
// MEMBERS TABLES

//--------------------------------------------------------------------------
if (isset($_GET['Insert_Member']))
{
	$insert_query = "INSERT INTO members (JoinDate, FirstName, LastName, MemberType, Email, Phone, Notes, Active) VALUES ('" . 
					$_GET['JoinDate']."','".$_GET['FirstName']."','".$_GET['LastName']."','".$_GET['MemberType']."','".$_GET['Email']."','".$_GET['Phone']."','".$_GET['Notes']."','".$_GET['Active']."')";
	
    $result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);  
    echo $result;
}

else if (isset($_GET['Update_View']))
{
    echo "0;0;0;";
}

else if (isset($_GET['Update_Member']))
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

else if (isset($_GET['Delete_Member']))
{
	$delete_query = "UPDATE  members SET deleted=1 WHERE ID='".$_GET['ID']."'";	
	$result = mysql_query($delete_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);
    echo $result;
}

else if (isset($_GET['Get_Member']))
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





//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
// EVENTS TABLES

//--------------------------------------------------------------------------
if (isset($_GET['Insert_Event']))
{
	$insert_query = "INSERT INTO Events (JoinDate, FirstName, LastName, EventType, Email, Phone, Notes, Active) VALUES ('" . 
					$_GET['JoinDate']."','".$_GET['FirstName']."','".$_GET['LastName']."','".$_GET['EventType']."','".$_GET['Email']."','".$_GET['Phone']."','".$_GET['Notes']."','".$_GET['Active']."')";
	
    $result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);  
    echo $result;
}

else if (isset($_GET['Update_View']))
{
    echo "0;0;0;";
}

else if (isset($_GET['Update_Event']))
{
	$update_query = "UPDATE Events SET 
	JoinDate='".$_GET['JoinDate']."',
	FirstName='".$_GET['FirstName']."',
	LastName='".$_GET['LastName']."',
	EventType='".$_GET['EventType']."',
	Email='".$_GET['Email']."',
	Active='".$_GET['Active']."'
	WHERE ID='".$_GET['ID']."'";
	
	$result = mysql_query($update_query) or die("SQL Error 1: " . $update_query ."---". mysql_error());

	mysql_close($connect);
}

else if (isset($_GET['Delete_Event']))
{
	$delete_query = "UPDATE  Events SET deleted=1 WHERE ID='".$_GET['ID']."'";	
	$result = mysql_query($delete_query) or die("SQL Error 1: " . mysql_error());
    mysql_close($connect);
    echo $result;
}

else if (isset($_GET['Get_Event']))
{
	$query = "SELECT * FROM Events WHERE deleted=0 ORDER BY ID DESC";

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$Events[] = array(
			'ID' => $row['ID'], 
			'JoinDate' => $row['JoinDate'],
			'FirstName' => $row['FirstName'],
			'LastName' => $row['LastName'],
			'EventType' => $row['EventType'],
			'Notes' => $row['Notes'],
			'Active' => $row['Active']
		  );
	}
	 
	echo json_encode($Events);
}
?>