<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
 
    $sql ="SELECT b.BookName, b.id, b.Copies, b.IssuedCopies, a.AuthorName 
           FROM books b 
           LEFT JOIN authors a ON b.AuthorId = a.id 
           WHERE b.ISBNNumber=:bookid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
  foreach ($results as $result) {
    $availableCopies = $result->Copies - $result->IssuedCopies;
    if($availableCopies > 0) {
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BookName);?></option>
<script>
$('#book_info').html('<div style="margin-top: 10px;"><b>Book Name:</b> <?php echo htmlentities($result->BookName);?><br/><b>Author:</b> <?php echo htmlentities($result->AuthorName ? $result->AuthorName : 'Unknown Author');?><br/><b>Available Copies:</b> <?php echo $availableCopies; ?> of <?php echo $result->Copies; ?></div>').show();
if(typeof checkFormValidity === 'function') checkFormValidity();
</script>
<?php  
    } else {
?>
<option class="others">Book Out of Stock</option>
<script>
$('#book_info').html('<div style="margin-top: 10px; color: red;"><b>Book Name:</b> <?php echo htmlentities($result->BookName);?><br/><b>Author:</b> <?php echo htmlentities($result->AuthorName ? $result->AuthorName : 'Unknown Author');?><br/><b>Status:</b> All copies are currently issued</div>').show();
$('#submit').prop('disabled',true);
</script>
<?php
    }
  }
}
 else{?>
  
<option class="others">Invalid ISBN Number</option>
<script>
$('#book_info').html('<div style="margin-top: 10px; color: red;"><b>Error:</b> No book found with this ISBN number</div>').show();
$('#submit').prop('disabled',true);
</script>
<?php
}
}
?>
