<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$bookPlace = $_POST['bookPlace'];
$bookPublisher = $_POST['bookPublisher'];
$year = $_POST['year'];
$bookEdition = $_POST['bookEdition'];
$section = $_POST['section'];
$bookStatus = $_POST['bookStatus'];
$callNumber = $_POST['callNumber'];
$bookid=intval($_GET['bookid']);
$sql="update  tblbooks set BookName=:bookname, Subject=:Subject, Author=:Author, ISBNNumber=:ISBNNumber, BookPlace=:BookPlace, BookPublisher=:BookPublisher, Year=:Year, BookEdition=:BookEdition, Section=:Section, BookStatus=:BookStatus, callNumber=:callNumber where id=:bookid";
//
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':Subject',$category,PDO::PARAM_STR);
$query->bindParam(':Author',$author,PDO::PARAM_STR);
$query->bindParam(':ISBNNumber',$isbn,PDO::PARAM_STR);
$query->bindParam(':BookPlace',$bookPlace,PDO::PARAM_STR);
$query->bindParam(':BookPublisher',$bookPublisher,PDO::PARAM_STR);
$query->bindParam(':Year',$year,PDO::PARAM_STR);
$query->bindParam(':BookEdition',$bookEdition,PDO::PARAM_STR);
$query->bindParam(':Section',$section,PDO::PARAM_STR);
$query->bindParam(':BookStatus',$bookStatus,PDO::PARAM_STR);
$query->bindParam(':callNumber',$callNumber,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Book info updated successfully');</script>";
echo "<script>window.location.href='manage-books.php'</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
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
                <h4 class="header-line">UPdate Book</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
$sql = "SELECT * From tblbooks where id=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<!-- <div class="col-md-6">
<div class="form-group">
<label>Book Image</label>
<img src="bookimg/<?php echo htmlentities($result->bookImage);?>" width="100">
<a href="change-bookimg.php?bookid=<?php echo htmlentities($result->bookid);?>">Change Book Image</a>
</div></div> -->

<div class="col-md-6">
<div class="form-group">
<label>Book Title<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" required />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Subject<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->Subject);?>"> <?php echo htmlentities($catname=$result->Subject);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblcategory where Status=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->CategoryName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->CategoryName);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php }}} ?> 
</select>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($result->Author);?>"> <?php echo htmlentities($athrname=$result->Author);?></option>
<?php 

$sql2 = "SELECT * from  tblauthors ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->AuthorName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->AuthorName);?>"><?php echo htmlentities($ret->AuthorName);?></option>
 <?php }}} ?> 
</select>
</div></div>


<div class="col-md-6">
<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber);?>" required />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div></div>


<!-- <div class="col-md-6">
 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->BookPrice);?>"   required="required" />
 </div></div>
 <?php }} ?><div class="col-md-12"> -->

 <div class="col-md-6">  
    <div class="form-group">
        <label>Book Place<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="bookPlace" autocomplete="off"   required="required"  value="<?php echo htmlentities($result->BookPlace);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Book Publisher<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="bookPublisher" autocomplete="off"   required="required"  value="<?php echo htmlentities($result->BookPublisher);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Year<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="year" autocomplete="off"   required="required" value="<?php echo htmlentities($result->Year);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Book Edition<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="bookEdition" autocomplete="off"   required="required" value="<?php echo htmlentities($result->BookEdition);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Section<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="section" autocomplete="off"   required="required" value="<?php echo htmlentities($result->Section);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Book Status<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="bookStatus" autocomplete="off"   required="required" value="<?php echo htmlentities($result->BookStatus);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group">
        <label>Call Number<span style="color:red;">*</span></label>
        <input class="form-control" type="text" name="callNumber" autocomplete="off"   required="required" value="<?php echo htmlentities($result->callNumber);?>" />
    </div>
</div>

<div class="col-md-6">  
    <div class="form-group" style="display:flex;justify-content:center;">
        <button type="submit" name="update" class="btn btn-info" style="margin-top:3.5rem; width:90%;">Update </button>
    </div>
</div>
</div>

                                    </form>
                            </div>
                        </div>
                            </div>

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
