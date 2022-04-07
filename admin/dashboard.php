<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
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
                <h4 class="header-line">ADMIN DASHBOARD</h4>
                
                            </div>

        </div>
             
             <div class="row">
<a href="manage-books.php">
 <div class="col-md-3 col-sm-3 col-xs-6">
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

            
       
             <a href="manage-issued-books.php">
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <!-- <i class="fa fa-recycle fa-5x"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="80" height="80"><path fill="#c24e00" d="M32 160h319.9l.0791 72c0 9.547 5.652 18.19 14.41 22c8.754 3.812 18.93 2.078 25.93-4.406l112-104c10.24-9.5 10.24-25.69 0-35.19l-112-104c-6.992-6.484-17.17-8.217-25.93-4.408c-8.758 3.816-14.41 12.46-14.41 22L351.9 96H32C14.31 96 0 110.3 0 127.1S14.31 160 32 160zM480 352H160.1L160 279.1c0-9.547-5.652-18.19-14.41-22C136.9 254.2 126.7 255.9 119.7 262.4l-112 104c-10.24 9.5-10.24 25.69 0 35.19l112 104c6.992 6.484 17.17 8.219 25.93 4.406C154.4 506.2 160 497.5 160 488L160.1 416H480c17.69 0 32-14.31 32-32S497.7 352 480 352z"/></svg></i>
<?php 
$sql2 ="SELECT id from tblissuedbookdetails where (RetrunStatus='' || RetrunStatus is null)";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
?>

                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                          Books Not Returned Yet
                        </div>
                    </div>
                </a>

  <a href="reg-students.php">
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <!-- <i class="fa fa-users fa-5x"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="80" height="80"><path fill="#c24e00" d="M0 24C0 10.75 10.75 0 24 0H616C629.3 0 640 10.75 640 24C640 37.25 629.3 48 616 48H24C10.75 48 0 37.25 0 24zM0 488C0 474.7 10.75 464 24 464H616C629.3 464 640 474.7 640 488C640 501.3 629.3 512 616 512H24C10.75 512 0 501.3 0 488zM211.2 160C211.2 195.3 182.5 224 147.2 224C111.9 224 83.2 195.3 83.2 160C83.2 124.7 111.9 96 147.2 96C182.5 96 211.2 124.7 211.2 160zM32 320C32 284.7 60.65 256 96 256H192C204.2 256 215.7 259.4 225.4 265.4C188.2 280.5 159.8 312.6 149.6 352H64C46.33 352 32 337.7 32 320V320zM415.9 264.6C425.3 259.1 436.3 256 448 256H544C579.3 256 608 284.7 608 320C608 337.7 593.7 352 576 352H493.6C483.2 311.9 453.1 279.4 415.9 264.6zM391.2 290.4C423.3 297.8 449.3 321.3 460.1 352C463.7 362 465.6 372.8 465.6 384C465.6 401.7 451.3 416 433.6 416H209.6C191.9 416 177.6 401.7 177.6 384C177.6 372.8 179.5 362 183.1 352C193.6 322.3 218.3 299.2 249.1 291.1C256.1 289.1 265.1 288 273.6 288H369.6C377 288 384.3 288.8 391.2 290.4zM563.2 160C563.2 195.3 534.5 224 499.2 224C463.9 224 435.2 195.3 435.2 160C435.2 124.7 463.9 96 499.2 96C534.5 96 563.2 124.7 563.2 160zM241.6 176C241.6 131.8 277.4 96 321.6 96C365.8 96 401.6 131.8 401.6 176C401.6 220.2 365.8 256 321.6 256C277.4 256 241.6 220.2 241.6 176z"/></svg></i>
                            <?php 
$sql3 ="SELECT id from tblstudents ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$regstds=$query3->rowCount();
?>
                            <h3><?php echo htmlentities($regstds);?></h3>
                           Registered Users
                        </div>
                    </div></a>


  <a href="manage-authors.php">
 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <!-- <i class="fa fa-user fa-5x"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="80" height="80"><path fill="#c24e00" d="M223.1 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 223.1 256zM274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512h286.4c-1.246-5.531-1.43-11.31-.2832-17.04l14.28-71.41c1.943-9.723 6.676-18.56 13.68-25.56l45.72-45.72C363.3 322.4 321.2 304 274.7 304zM371.4 420.6c-2.514 2.512-4.227 5.715-4.924 9.203l-14.28 71.41c-1.258 6.289 4.293 11.84 10.59 10.59l71.42-14.29c3.482-.6992 6.682-2.406 9.195-4.922l125.3-125.3l-72.01-72.01L371.4 420.6zM629.5 255.7l-21.1-21.11c-14.06-14.06-36.85-14.06-50.91 0l-38.13 38.14l72.01 72.01l38.13-38.13C643.5 292.5 643.5 269.7 629.5 255.7z"/></svg></i>
<?php 
$sq4 ="SELECT id from tblauthors ";
$query4 = $dbh -> prepare($sq4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$listdathrs=$query4->rowCount();
?>
<h3><?php echo htmlentities($listdathrs);?></h3>
Authors Listed
</div>
</div></a>
</div>



 <div class="row">



  <a href="manage-categories.php">            
<div class="col-md-3 col-sm-3 rscol-xs-6">
<div class="alert alert-info back-widget-set text-center">
<!-- <i class="fa fa-file-archive-o fa-5x"></i> -->
<i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="80" height="80"><path fill="#c24e00" d="M0 96C0 60.65 28.65 32 64 32H512C547.3 32 576 60.65 576 96V416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V96zM160 256C160 238.3 145.7 224 128 224C110.3 224 96 238.3 96 256C96 273.7 110.3 288 128 288C145.7 288 160 273.7 160 256zM160 160C160 142.3 145.7 128 128 128C110.3 128 96 142.3 96 160C96 177.7 110.3 192 128 192C145.7 192 160 177.7 160 160zM160 352C160 334.3 145.7 320 128 320C110.3 320 96 334.3 96 352C96 369.7 110.3 384 128 384C145.7 384 160 369.7 160 352zM224 136C210.7 136 200 146.7 200 160C200 173.3 210.7 184 224 184H448C461.3 184 472 173.3 472 160C472 146.7 461.3 136 448 136H224zM224 232C210.7 232 200 242.7 200 256C200 269.3 210.7 280 224 280H448C461.3 280 472 269.3 472 256C472 242.7 461.3 232 448 232H224zM224 328C210.7 328 200 338.7 200 352C200 365.3 210.7 376 224 376H448C461.3 376 472 365.3 472 352C472 338.7 461.3 328 448 328H224z"/></svg></i>
<?php 
$sql5 ="SELECT id from tblcategory ";
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$listdcats=$query5->rowCount();
?>

                            <h3><?php echo htmlentities($listdcats);?> </h3>
                           Listed Categories
                        </div>
                    </div></a>
             

        </div>             
            
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
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
