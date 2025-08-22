<?php 

//require_once 'core.php';
require_once 'includes/config.php';
	
	$sql = "SELECT students.FullName,books.BookName,books.ISBNNumber,books.id,issuedbookdetails.IssuesDate,issuedbookdetails.ReturnDate,issuedbookdetails.id as rid from  issuedbookdetails join students on students.StudentId=issuedbookdetails.StudentId join books on books.id=issuedbookdetails.BookId order by issuedbookdetails.id desc";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Student Name</th>
			<th>Book Name</th>
			<th>Book ID</th>
			<th>ISBN Number</th>
			<th>Issued Date</th>
			<th>Return Date</th>
		</tr>

		<tr>';
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{  
			//echo"<script>alert('".$result->FullName."')</script>";
			$table .= '<tr>
				<td><center>'.$result->FullName.'</center></td>
				<td><center>'.$result->BookName.'</center></td>
				<td><center>'.$result->id.'</center></td>
				<td><center>'.$result->ISBNNumber.'</center></td>
				<td><center>'.$result->IssuesDate.'</center></td>
				<td><center>'.$result->ReturnDate.'</center></td>
			</tr>';	
		}
		}
		$table .= '
		</tr>		
	</table>
	<button onClick="window.print()">Print this page</button>
	';	

	echo $table;



?>