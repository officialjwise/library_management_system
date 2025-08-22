<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
$studentid=$_POST['studentid'];
$indexnumber=$_POST['indexnumber'];
$fname=$_POST['fullanme'];
$college=$_POST['college'];
$department=$_POST['department'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;

// Validate Student ID (8 digits)
if(!preg_match('/^\d{8}$/', $studentid)) {
    echo "<script>alert('Student ID must be exactly 8 digits');</script>";
    exit;
}

// Validate Index Number (7 digits)
if(!preg_match('/^\d{7}$/', $indexnumber)) {
    echo "<script>alert('Index Number must be exactly 7 digits');</script>";
    exit;
}

// Check if Student ID already exists
$checkstudent="SELECT StudentId FROM students WHERE StudentId=:studentid";
$querychk = $dbh -> prepare($checkstudent);
$querychk->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$querychk->execute();
if($querychk->rowCount() > 0)
{
echo "<script>alert('Student ID already exists. Please use a different Student ID');</script>";
}
// Check if Index Number already exists
else {
$checkindex="SELECT IndexNumber FROM students WHERE IndexNumber=:indexnumber";
$querychkindex = $dbh -> prepare($checkindex);
$querychkindex->bindParam(':indexnumber',$indexnumber,PDO::PARAM_STR);
$querychkindex->execute();
if($querychkindex->rowCount() > 0)
{
echo "<script>alert('Index Number already exists. Please use a different Index Number');</script>";
}
else {
$sql="INSERT INTO students(StudentId,IndexNumber,FullName,College,Department,MobileNumber,EmailId,Password,Status) VALUES(:studentid,:indexnumber,:fname,:college,:department,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->bindParam(':indexnumber',$indexnumber,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':college',$college,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Registration successful! Student ID: '.$studentid.' | Index Number: '.$indexnumber.'")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script type="text/javascript">
function valid()
{
// Validate Student ID (8 digits)
var studentid = document.signup.studentid.value;
if(!/^\d{8}$/.test(studentid)) {
    alert("Student ID must be exactly 8 digits!");
    document.signup.studentid.focus();
    return false;
}

// Validate Index Number (7 digits)
var indexnumber = document.signup.indexnumber.value;
if(!/^\d{7}$/.test(indexnumber)) {
    alert("Index Number must be exactly 7 digits!");
    document.signup.indexnumber.focus();
    return false;
}

// Validate password confirmation
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function loadDepartments() {
var college = $("#college").val();
if(college != "") {
    $("#department").html('<option value="">Loading...</option>');
    $.ajax({
        url: "get_departments.php",
        type: "POST",
        data: {college: college},
        success: function(data) {
            $("#department").html(data);
        },
        error: function() {
            $("#department").html('<option value="">Error loading departments</option>');
        }
    });
} else {
    $("#department").html('<option value="">Select College First</option>');
}
}
</script>    

</head>
<body>
    <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">User Signup</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           SINGUP FORM
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">

<div class="form-group">
<label>Student ID (8 digits) <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="studentid" maxlength="8" pattern="\d{8}" title="Please enter exactly 8 digits" placeholder="e.g., 20857953" autocomplete="off" required />
<small class="text-muted">Enter your 8-digit KNUST Student ID</small>
</div>

<div class="form-group">
<label>Index Number (7 digits) <span style="color:red;">*</span></label>
<input class="form-control" type="text" name="indexnumber" maxlength="7" pattern="\d{7}" title="Please enter exactly 7 digits" placeholder="e.g., 8552721" autocomplete="off" required />
<small class="text-muted">Enter your 7-digit Index Number</small>
</div>

<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullanme" autocomplete="off" required />
</div>

<div class="form-group">
<label>Select College <span style="color:red;">*</span></label>
<select class="form-control" name="college" id="college" required onchange="loadDepartments()">
<option value="">Select College</option>
<?php 
$sql = "SELECT id, CollegeName FROM colleges WHERE Status=1 ORDER BY CollegeName";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0) {
    foreach($results as $result) { ?>
        <option value="<?php echo htmlentities($result->CollegeName);?>"><?php echo htmlentities($result->CollegeName);?></option>
    <?php }
} ?>
</select>
</div>

<div class="form-group">
<label>Select Department <span style="color:red;">*</span></label>
<select class="form-control" name="department" id="department" required>
<option value="">Select College First</option>
</select>
</div>


<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>
                              
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
