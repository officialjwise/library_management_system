<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
    $studentid=strtoupper($_POST['studentid']);
    $isbn=$_POST['bookid']; // This is actually the ISBN from the form
    
    // First, get the book ID from the ISBN
    $sql = "SELECT id, BookName, Copies, IssuedCopies FROM books WHERE ISBNNumber=:isbn";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $query->execute();
    $bookInfo = $query->fetch(PDO::FETCH_OBJ);
    
    if(!$bookInfo) {
        $_SESSION['error'] = "Book not found with ISBN: " . $isbn;
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
    
    $bookid = $bookInfo->id;
    
    // Check if book is available
    if(($bookInfo->Copies - $bookInfo->IssuedCopies) <= 0) {
        $_SESSION['error'] = "Book is not available - all copies are issued";
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
    
    // Check if student is valid and active
    $sql = "SELECT FullName, Status FROM students WHERE StudentId=:studentid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->execute();
    $studentInfo = $query->fetch(PDO::FETCH_OBJ);
    
    if(!$studentInfo) {
        $_SESSION['error'] = "Student not found with ID: " . $studentid;
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
    
    if($studentInfo->Status != 1) {
        $_SESSION['error'] = "Student account is blocked or inactive";
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
    
    // Check if this book is already issued to this student
    $sql = "SELECT id FROM issuedbookdetails WHERE StudentID=:studentid AND BookId=:bookid AND ReturnStatus=0";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0) {
        $_SESSION['error'] = "This book is already issued to this student";
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
    
    try {
        // Begin transaction
        $dbh->beginTransaction();
        
        // Issue the book
        $sql="INSERT INTO issuedbookdetails(StudentID,BookId,ReturnStatus) VALUES(:studentid,:bookid,0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        if(!$lastInsertId) {
            throw new Exception("Failed to insert book issue record");
        }
        
        // Update book issued copies count
        $sql="UPDATE books SET IssuedCopies=IssuedCopies+1 WHERE id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
        $query->execute();
        
        // Remove from requested books (using GET parameters)
        $requestISBN = $_GET['ISBNNumber'] ?? $isbn;
        $requestStudentID = $_GET['StudentID'] ?? $studentid;
        
        $sql="DELETE FROM requestedbookdetails WHERE StudentID=:studentid AND ISBNNumber=:isbn";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $requestStudentID, PDO::PARAM_STR);
        $query->bindParam(':isbn', $requestISBN, PDO::PARAM_STR);
        $query->execute();
        
        // Commit transaction
        $dbh->commit();
        
        $_SESSION['msg'] = "Book '" . $bookInfo->BookName . "' issued successfully to " . $studentInfo->FullName;
        header('location:manage-issued-books.php');
        exit;
        
    } catch(Exception $e) {
        // Rollback transaction
        $dbh->rollback();
        $_SESSION['error'] = "Error issuing book: " . $e->getMessage();
        header('location:issue-book2.php?ISBNNumber=' . urlencode($isbn) . '&StudentID=' . urlencode($studentid));
        exit;
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){
$("#get_student_name").html('<span style="color:red">Error loading student information</span>');
$("#loaderIcon").hide();
}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){
$("#get_book_name").html('<option value="">Error loading book information</option>');
$("#loaderIcon").hide();
}
});
}

// Auto-load information when page loads
$(document).ready(function() {
    if($("#studentid").val()) {
        getstudent();
    }
    if($("#bookid").val()) {
        getbook();
    }
});

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a New Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>
<div class="panel-body">

<?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
<div class="alert alert-danger">
<strong>ERROR :</strong> 
<?php echo htmlentities($_SESSION['error']);?>
<?php $_SESSION['error']="";?>
</div>
<?php } ?>

<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
<div class="alert alert-success">
<strong>SUCCESS :</strong> 
<?php echo htmlentities($_SESSION['msg']);?>
<?php $_SESSION['msg']="";?>
</div>
<?php } ?>

<form method="post" class="form-horizontal">
										
<?php	
$bookid=$_GET['ISBNNumber'] ?? '';
$stdid=$_GET['StudentID'] ?? '';

if(empty($bookid) || empty($stdid)) {
    echo '<div class="alert alert-warning">Missing required parameters. Please access this page from the "Manage Requested Books" page.</div>';
    echo '<a href="manage-requested-books.php" class="btn btn-primary">← Go to Manage Requested Books</a>';
} else {
?>										
<div class="form-group">
<label>Student ID<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" value="<?php echo htmlentities($stdid);?>" onBlur="getstudent()" required readonly />
<small class="text-muted">Student ID from the book request</small>
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>

<div id="loaderIcon" style="display:none; margin: 10px 0;">
<i class="fa fa-spinner fa-spin"></i> Loading...
</div>

<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookid" id="bookid" value="<?php echo htmlentities($bookid);?>" onBlur="getbook()" required readonly />
<small class="text-muted">ISBN from the book request</small>
</div>

 <div class="form-group">
  <label>Book Details</label>
  <select class="form-control" name="bookdetails" id="get_book_name" readonly> 
    <option value="">Loading book details...</option>
  </select>
 </div>

<div class="form-group">
<button type="submit" name="issue" id="submit" class="btn btn-success">Issue Book to Student</button>
<a href="manage-requested-books.php" class="btn btn-default">Cancel</a>
</div>

<?php } ?>

										</form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
