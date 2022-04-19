<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
 
    $sql ="SELECT distinct tblbooks.BookName,tblbooks.id,tblbooks.Author,tblbooks.isIssued,tblbooks.isIssued,tblbooks.ISBNNumber FROM tblbooks
    join tblauthors on tblauthors.id=tblbooks.AuthorId
     WHERE (callNumber=:bookid)";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
  $query-> execute();
  $results = $query -> fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query -> rowCount() > 0)
  {
    foreach ($results as $result){
      $bookName = $result->BookName;
      $isbn = $result->ISBNNumber;
      $author = $result->Author;
      $id = $result->id;
      if($result->isIssued=='0')
      {
        echo "<table border='1'>
        <tr>
          <th style='padding-left:2%; width: 10%;'>
          <p style='margin-top:1rem;'>Book Title: $bookName</p>
          <p>Book ISBN: $isbn</p>
          <p>Book Author: $author</p>
          <label>Select Book</label>
          <input type='radio' name='bookid' value='$id' required>
          </th>
        </tr>
        </table>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
      }
      else
      {
        echo "<p style='color:red;'>Book Already issued</p>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
      }
    }
  }
  else
  {
    echo"<p>Record not found. Please try again.</p>"; 
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}
?>
