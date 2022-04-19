<?php 
require_once("includes/config.php");
if(!empty($_POST["studentid"])) {
  $studentid= strtoupper($_POST["studentid"]);
 
    $sql ="SELECT FullName,Status,EmailId,MobileNumber,Course,Year,Section FROM tblstudents WHERE EmailId=:studentid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':studentid', $studentid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> Student Number Blocked </span>"."<br />";
echo "<b>Student Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo "Name: " . htmlentities($result->FullName)."<br />";
echo "Student Number: " . htmlentities($result->EmailId)."<br />";
echo "Course/Year/Section: " .htmlentities($result->Course)."-".htmlentities($result->Year)."-".htmlentities($result->Section)."<br />";
echo "Mobile Number: ". htmlentities($result->MobileNumber);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Invaid Student Number. Please Enter Valid Student Number.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
