<?php
include('includes/config.php');

if(isset($_POST['college'])) {
    $college = $_POST['college'];
    
    $sql = "SELECT d.DepartmentName 
            FROM departments d 
            INNER JOIN colleges c ON d.CollegeId = c.id 
            WHERE c.CollegeName = :college AND d.Status = 1 
            ORDER BY d.DepartmentName";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':college', $college, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    echo '<option value="">Select Department</option>';
    
    if($query->rowCount() > 0) {
        foreach($results as $result) {
            echo '<option value="'.htmlentities($result->DepartmentName).'">'.htmlentities($result->DepartmentName).'</option>';
        }
    } else {
        echo '<option value="">No departments found</option>';
    }
}
?>
