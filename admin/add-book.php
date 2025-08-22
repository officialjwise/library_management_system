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

if(isset($_POST['add']))
{
    // Validate and sanitize input data
    $bookname = trim($_POST['bookname']);
    $category = intval($_POST['category']);
    $author = intval($_POST['author']);
    $isbn = trim($_POST['isbn']);
    $price = floatval($_POST['price']);
    $copies = intval($_POST['copies']);
    
    // Validation
    $errors = array();
    
    if(empty($bookname)) {
        $errors[] = "Book name is required";
    }
    
    if($category <= 0) {
        $errors[] = "Please select a valid category";
    }
    
    if($author <= 0) {
        $errors[] = "Please select a valid author/publication";
    }
    
    if(empty($isbn)) {
        $errors[] = "ISBN number is required";
    }
    
    if($price <= 0) {
        $errors[] = "Price must be greater than 0";
    }
    
    if($copies <= 0) {
        $errors[] = "Number of copies must be greater than 0";
    }
    
    // Check if ISBN already exists
    if(!empty($isbn)) {
        $check_sql = "SELECT id FROM books WHERE ISBNNumber = :isbn";
        $check_query = $dbh->prepare($check_sql);
        $check_query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $check_query->execute();
        if($check_query->rowCount() > 0) {
            $errors[] = "ISBN number already exists. Please use a unique ISBN.";
        }
    }
    
    if(empty($errors)) {
        try {
            $sql = "INSERT INTO books(BookName,CatId,AuthorId,ISBNNumber,BookPrice,Copies,IssuedCopies) VALUES(:bookname,:category,:author,:isbn,:price,:copies,0)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_INT);
            $query->bindParam(':author', $author, PDO::PARAM_INT);
            $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $query->bindParam(':price', $price, PDO::PARAM_STR);
            $query->bindParam(':copies', $copies, PDO::PARAM_INT);
            
            if($query->execute()) {
                $lastInsertId = $dbh->lastInsertId();
                $_SESSION['msg'] = "Book '" . htmlentities($bookname) . "' added successfully with ISBN: " . htmlentities($isbn);
                header('location:manage-books.php');
                exit();
            } else {
                $errorInfo = $query->errorInfo();
                $_SESSION['error'] = "Database error: " . $errorInfo[2];
            }
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error adding book: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
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
    <title>Online Library Management System | Add Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

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
                <h4 class="header-line">Add Book</h4>
                
                <!-- Display Success Message -->
                <?php if(isset($_SESSION['msg'])) { ?>
                <div class="alert alert-success">
                    <?php echo htmlentities($_SESSION['msg']); ?>
                    <?php unset($_SESSION['msg']); ?>
                </div>
                <?php } ?>
                
                <!-- Display Error Message -->
                <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
                <?php } ?>
                
            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off"  required />
</div>

<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value=""> Select Category</option>
<?php 
$status=1;
$sql = "SELECT * from  category where Status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label> Publication<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value=""> Select Publication</option>
<?php 

$sql = "SELECT * from  authors ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div>
 
 <div class="form-group">
 <label>No of Copies<span style="color:red;">*</span></label>
 <input class="form-control" type="number" name="copies" min="1" autocomplete="off" required="required" />
 </div>
 
 <div class="form-group">
 <label>Price in GH₵<span style="color:red;">*</span></label>
 <input class="form-control" type="number" step="0.01" min="0.01" name="price" placeholder="Enter price in Ghana Cedis" autocomplete="off" required="required" />
 </div>
<button type="submit" name="add" class="btn btn-info">Add </button>

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
