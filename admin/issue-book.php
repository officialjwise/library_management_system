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
$bookid=$_POST['bookdetails'];

// Validate inputs
if(empty($studentid) || empty($bookid)) {
    $_SESSION['error']="Please fill all required fields";
    header('location:issue-book.php');
    exit;
}

// First check if book has available copies
$checkAvailability = "SELECT Copies, IssuedCopies, BookName FROM books WHERE id=:bookid";
$checkQuery = $dbh->prepare($checkAvailability);
$checkQuery->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$checkQuery->execute();
$bookInfo = $checkQuery->fetch(PDO::FETCH_OBJ);

if($bookInfo && ($bookInfo->Copies - $bookInfo->IssuedCopies) > 0) {
    // Check if student exists and is active
    $checkStudent = "SELECT Status, FullName FROM students WHERE StudentId=:studentid";
    $studentQuery = $dbh->prepare($checkStudent);
    $studentQuery->bindParam(':studentid',$studentid,PDO::PARAM_STR);
    $studentQuery->execute();
    $studentInfo = $studentQuery->fetch(PDO::FETCH_OBJ);
    
    if($studentInfo) {
        if($studentInfo->Status == 1) {
            // Check if student already has this book issued
            $checkIssued = "SELECT id FROM issuedbookdetails WHERE StudentID=:studentid AND BookId=:bookid AND ReturnStatus=0";
            $issuedQuery = $dbh->prepare($checkIssued);
            $issuedQuery->bindParam(':studentid',$studentid,PDO::PARAM_STR);
            $issuedQuery->bindParam(':bookid',$bookid,PDO::PARAM_STR);
            $issuedQuery->execute();
            
            if($issuedQuery->rowCount() == 0) {
                // Issue the book
                $sql="INSERT INTO issuedbookdetails(StudentID,BookId,ReturnStatus) VALUES(:studentid,:bookid,0)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
                $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                
                if($lastInsertId)
                {
                    // Update issued copies count
                    $sql="UPDATE books SET IssuedCopies=IssuedCopies+1 WHERE id=:bookid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
                    $query->execute();
                    
                    $_SESSION['msg']="Book '" . $bookInfo->BookName . "' issued successfully to " . $studentInfo->FullName;
                    header('location:manage-issued-books.php');
                    exit;
                }
                else 
                {
                    $_SESSION['error']="Something went wrong. Please try again";
                    header('location:issue-book.php');
                    exit;
                }
            } else {
                $_SESSION['error']="This book is already issued to this student";
                header('location:issue-book.php');
                exit;
            }
        } else {
            $_SESSION['error']="Student ID is blocked or inactive";
            header('location:issue-book.php');
            exit;
        }
    } else {
        $_SESSION['error']="Invalid Student ID";
        header('location:issue-book.php');
        exit;
    }
} else {
    $_SESSION['error']="Book is not available or out of stock";
    header('location:issue-book.php');
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
checkFormValidity();
},
error:function (){
$("#get_student_name").html('<span style="color:red">Error loading student information</span>');
$("#loaderIcon").hide();
$("#submit").prop('disabled',true);
}
});
}

//function for book details
function getbook() {
var isbn = $("#bookid").val();
if(isbn.length > 0) {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+isbn,
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
checkFormValidity();
},
error:function (){
$("#get_book_name").html('<option value="">Error loading book information</option>');
$("#book_info").hide();
$("#submit").prop('disabled',true);
$("#loaderIcon").hide();
}
});
} else {
$("#get_book_name").html('<option value="">Enter ISBN number above to get book details</option>');
$("#book_info").hide();
$("#submit").prop('disabled',true);
}
}

function checkFormValidity() {
var studentValid = $("#get_student_name").text().includes("Student Name:");
var bookValid = $("#get_book_name option:selected").val() && $("#get_book_name option:selected").val() != "";
var bookNotOutOfStock = !$("#get_book_name option:selected").hasClass("others");
    
if(studentValid && bookValid && bookNotOutOfStock) {
    $("#submit").prop('disabled',false);
} else {
    $("#submit").prop('disabled',true);
}
}

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
<?php if($_SESSION['error']!=""){?>
<div class="alert alert-danger">
<strong>ERROR :</strong> 
<?php echo htmlentities($_SESSION['error']);?>
<?php $_SESSION['error']="";?>
</div>
<?php } ?>

<?php if($_SESSION['msg']!=""){?>
<div class="alert alert-success">
<strong>SUCCESS :</strong> 
<?php echo htmlentities($_SESSION['msg']);?>
<?php $_SESSION['msg']="";?>
</div>
<?php } ?>

<form role="form" method="post">

<div class="form-group">
<label>Student id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
</div>

<div class="form-group">
<span id="get_student_name" style="font-size:16px;"></span> 
</div>

<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookid" id="bookid" onBlur="getbook()" placeholder="Enter ISBN Number" required="required" />
<small class="text-muted">Enter the book's ISBN number to search</small>
<div id="loaderIcon" style="display:none; margin-top: 5px;">
<i class="fa fa-spinner fa-spin"></i> Loading...
</div>
</div>

<div class="form-group">
  <label>Book Details</label>
  <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
   <option value="">Enter ISBN number above to get book details</option>
 </select>
 </div>

 <div id="book_info" style="margin-top: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 5px; display: none;">
   <!-- Book information will be displayed here -->
 </div>
  <div class="form-group">
<button type="submit" name="issue" id="submit" class="btn btn-info" disabled>Issue Book </button>
<small class="text-muted">Please enter valid Student ID and ISBN to enable the submit button</small>
</div>
                            </div>
							     </form>
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

<!-- Test data for debugging -->
<div style="margin: 20px; padding: 10px; background-color: #f0f0f0; border-radius: 5px;">
    <h4>Test Data (for debugging):</h4>
    <p><strong>Student ID:</strong> 20857953</p>
    <p><strong>Available ISBNs:</strong> 9780385474542, 9781101947135, 9780435905200</p>
</div>

</body>
</html>
<?php } ?>
