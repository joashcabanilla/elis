<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-LIBRARY INFORMATION SYSTEM | User Dash Board</title>
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
                <h4 class="header-line">User DASHBOARD</h4>
                
                            </div>

        </div>
             
             <div class="row">


<a href="listed-books.php">
<div class="col-md-4 col-sm-4 col-xs-6">
 <div class="alert alert-success back-widget-set text-center">
 <!-- <i class="fa fa-book fa-5x"></i> -->
 <i> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="80" height="80"><path fill="#c24e00" d="M240 97.25C232.3 104.8 219.3 131.8 216.6 176h46.88C260.8 131.8 247.8 104.8 240 97.25zM334.4 176c-5.25-31.25-25.62-57.13-53.25-70.38C288.8 124.6 293.8 149 295.3 176H334.4zM334.4 208h-39.13c-1.5 27-6.5 51.38-14.12 70.38C308.8 265.1 329.1 239.3 334.4 208zM263.4 208H216.5C219.3 252.3 232.3 279.3 240 286.8C247.8 279.3 260.8 252.3 263.4 208zM198.9 105.6C171.3 118.9 150.9 144.8 145.6 176h39.13C186.3 149 191.3 124.6 198.9 105.6zM448 336v-288C448 21.49 426.5 0 400 0H96C42.98 0 0 42.98 0 96v320c0 53.02 42.98 96 96 96h320c17.67 0 32-14.33 32-32c0-11.72-6.607-21.52-16-27.1v-81.36C441.8 362.8 448 350.2 448 336zM240 64c70.75 0 128 57.25 128 128s-57.25 128-128 128s-128-57.25-128-128S169.3 64 240 64zM384 448H96c-17.67 0-32-14.33-32-32c0-17.67 14.33-32 32-32h288V448zM198.9 278.4C191.3 259.4 186.3 235 184.8 208H145.6C150.9 239.3 171.3 265.1 198.9 278.4z"/></svg></i>
<?php 
$sql ="SELECT id from tblbooks ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listdbooks=$query->rowCount();
?>
<h3><?php echo htmlentities($listdbooks);?></h3>
Books Listed
</div></div></a>
             
               <div class="col-md-4 col-sm-4 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <!-- <i class="fa fa-recycle fa-5x"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="80" height="80"><path fill="#c24e00" d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"/></svg></i>
<?php 
$rsts=0;
 $sid=$_SESSION['stdid'];
$sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and (RetrunStatus=:rsts || RetrunStatus is null || RetrunStatus='')";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':sid',$sid,PDO::PARAM_STR);
$query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
?>

                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                          Books Not Returned Yet
                        </div>
                    </div>

<a href="issued-books.php">
<div class="col-md-4 col-sm-4 col-xs-6">
 <div class="alert alert-success back-widget-set text-center">
 <!-- <i class="fa fa-book fa-5x"></i> -->
 <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="80" height="80"><path fill="#c24e00" d="M448 336v-288C448 21.49 426.5 0 400 0H96C42.98 0 0 42.98 0 96v320c0 53.02 42.98 96 96 96h320c17.67 0 32-14.33 32-31.1c0-11.72-6.607-21.52-16-27.1v-81.36C441.8 362.8 448 350.2 448 336zM143.1 128h192C344.8 128 352 135.2 352 144C352 152.8 344.8 160 336 160H143.1C135.2 160 128 152.8 128 144C128 135.2 135.2 128 143.1 128zM143.1 192h192C344.8 192 352 199.2 352 208C352 216.8 344.8 224 336 224H143.1C135.2 224 128 216.8 128 208C128 199.2 135.2 192 143.1 192zM384 448H96c-17.67 0-32-14.33-32-32c0-17.67 14.33-32 32-32h288V448z"/></svg></i>
      <h3>&nbsp;</h3>
Issued Books
</div></div></a>





        </div>    
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
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
