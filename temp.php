<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{

// Validate that all required parameters are present
$required_params = ['StudentID', 'StudName', 'ISBNNumber', 'BookName', 'AuthorName', 'CategoryName', 'BookPrice'];
$missing_params = [];

foreach($required_params as $param) {
    if(!isset($_GET[$param]) || empty($_GET[$param])) {
        $missing_params[] = $param;
    }
}

if(!empty($missing_params)) {
    $_SESSION['error'] = "Missing required parameters: " . implode(', ', $missing_params);
    header('location:request-a-book.php');
    exit;
}

$StudentID=$_GET['StudentID'];
$StudName=$_GET['StudName'];
$ISBNNumber=$_GET['ISBNNumber'];
$BookName=$_GET['BookName'];
$AuthorName=$_GET['AuthorName'];
$CategoryName=$_GET['CategoryName'];
$BookPrice=$_GET['BookPrice'];

$sql = "SELECT * from requestedbookdetails where StudentID=:StudentID and ISBNNumber=:ISBNNumber";
$query = $dbh -> prepare($sql);
$query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
$query->bindParam(':ISBNNumber',$ISBNNumber,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
$_SESSION['error']="You have already requested this book";
header('location:request-a-book.php');
exit;
}
else{
  $sql = "SELECT * from requestedbookdetails where StudentID=:StudentID";
  $query = $dbh -> prepare($sql);
  $query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() >= 2)
  {
	$_SESSION['error']="You cannot request more than 2 books at a time";
	header('location:request-a-book.php');
	exit;
  }
  else 
  {
	try {
		$sql="INSERT INTO requestedbookdetails(StudentID,StudName,BookName,CategoryName,AuthorName,ISBNNumber,BookPrice) VALUES(:StudentID,:StudName,:BookName,:CategoryName,:AuthorName,:ISBNNumber,:BookPrice)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':StudentID',$StudentID,PDO::PARAM_STR);
		$query->bindParam(':StudName',$StudName,PDO::PARAM_STR);
		$query->bindParam(':BookName',$BookName,PDO::PARAM_STR);
		$query->bindParam(':CategoryName',$CategoryName,PDO::PARAM_STR);
		$query->bindParam(':AuthorName',$AuthorName,PDO::PARAM_STR);
		$query->bindParam(':ISBNNumber',$ISBNNumber,PDO::PARAM_STR);
		$query->bindParam(':BookPrice',$BookPrice,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		
		if($lastInsertId) {
			$_SESSION['msg']="Book '" . $BookName . "' requested successfully";
		} else {
			$_SESSION['error']="Failed to submit book request. Please try again.";
		}
		header('location:request-a-book.php');
		exit;
	} catch(PDOException $e) {
		$_SESSION['error']="Error submitting request: " . $e->getMessage();
		header('location:request-a-book.php');
		exit;
	}
  }
}
}?>


