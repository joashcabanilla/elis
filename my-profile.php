<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{    
$sid=$_SESSION['stdid'];  
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$course = $_POST['course'];
$year = $_POST['year'];
$section = $_POST['section'];
$email = $_POST['email'];

$sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno,Course=:Course,Year=:Year,Section=:Section,EmailId=:EmailId where StudentId=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':Course',$course,PDO::PARAM_STR);
$query->bindParam(':Year',$year,PDO::PARAM_STR);
$query->bindParam(':Section',$section,PDO::PARAM_STR);
$query->bindParam(':EmailId',$email,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile has been updated")</script>';
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
    <title>E-LIBRARY INFORMATION SYSTEM</title>
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
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">My Profile</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           My Profile
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post">
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status,Course,Year,Section from  tblstudents  where StudentId=:sid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>Student Number : </label>
<?php echo htmlentities($result->EmailId);?>
</div>

<div class="form-group">
<label>Registration Date : </label>
<?php echo htmlentities($result->RegDate);?>
</div>
<?php if($result->UpdationDate!=""){?>
<div class="form-group">
<label>Date Modified : </label>
<?php echo htmlentities($result->UpdationDate);?>
</div>
<?php } ?>


<div class="form-group">
<label>Profile Status : </label>
<?php if($result->Status==1){?>
<span style="color: green">Active</span>
<?php } else { ?>
<span style="color: red">Blocked</span>
<?php }?>
</div>


<div class="form-group">
<label>Full Name</label>
<input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required />
</div>


<div class="form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="mobileno" maxlength="11" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Student Number</label>
<input class="form-control" type="number" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>"  autocomplete="off" required />
</div>

<div class="form-group">
<label>Course</label>
<input class="form-control" type="text" name="course" id="course" value="<?php echo htmlentities($result->Course);?>"  autocomplete="off" required />
</div>

<div class="form-group">
<label>Year</label>
<select class="form-control" name="year" id="year">
    <option hidden value="<?php echo htmlentities($result->Year);?>"><?php echo htmlentities($result->Year);?></option>
    <option value="1ST">1ST</option>
    <option value="2ND">2ND</option>
    <option value="3RD">3RD</option>
    <option value="4TH">4TH</option>
</select>
</div>

<div class="form-group">
<label>Section</label>
<input class="form-control" type="text" name="section" id="section" value="<?php echo htmlentities($result->Section);?>"  autocomplete="off" required />
</div>
<?php }} ?>
                              
<button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>

                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
