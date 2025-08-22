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
}
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Request a Book</h4>
    </div>
     <div class="row">
    <?php if(isset($_SESSION['error']) && $_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>



   <?php if(isset($_SESSION['delmsg']) && $_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Available Books 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
											<th>Category</th>
											<th>Publication Name</th>
                                            <th>ISBN </th>
                                            <th>Price (GH₵)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT books.BookName,books.Copies,books.IssuedCopies,category.CategoryName,authors.AuthorName,books.ISBNNumber,books.BookPrice,books.id as bookid from  books join category on category.id=books.CatId join authors on authors.id=books.AuthorId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{     
if($result->Copies > $result->IssuedCopies)
{          ?>                               
                                        <tr class="odd gradeX">
										    
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                            <td class="center"><?php echo htmlentities($result->CategoryName);?></td>
                                            <td class="center"><?php echo htmlentities($result->AuthorName);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                            <td class="center">GH₵<?php echo number_format($result->BookPrice, 2);?></td>
											<td class="center">
											<?php
											$requestUrl = "temp.php?" . http_build_query([
											    'ISBNNumber' => $result->ISBNNumber,
											    'BookName' => $result->BookName,
											    'AuthorName' => $result->AuthorName,
											    'CategoryName' => $result->CategoryName,
											    'BookPrice' => $result->BookPrice,
											    'StudName' => $_SESSION['username'] ?? 'Unknown',
											    'StudentID' => $_SESSION['stdid'] ?? ''
											]);
											?>
											<a href="<?php echo $requestUrl; ?>">
											    <button class="btn btn-primary" name="submit" id="submit" type="submit">
											        <i class="fa fa-edit "></i> Request
											    </button>
											</a>
											
											<!-- Debug link -->
											<br><small><a href="debug-request.php?<?php echo http_build_query([
											    'ISBNNumber' => $result->ISBNNumber,
											    'BookName' => $result->BookName,
											    'AuthorName' => $result->AuthorName,
											    'CategoryName' => $result->CategoryName,
											    'BookPrice' => $result->BookPrice,
											    'StudName' => $_SESSION['username'] ?? 'Unknown',
											    'StudentID' => $_SESSION['stdid'] ?? ''
											]); ?>" target="_blank">Debug</a></small>
											</td>		
                                        </tr>
<?php $cnt=$cnt+1;}}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>