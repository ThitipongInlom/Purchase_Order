<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PRA SHOW</title>
<style type="text/css">
.table-striped  > tbody > tr:nth-child(2n+1) > td, .table-striped  > tbody > tr:nth-child(2n+1) > th {
  background-color: #D4E6F1;
  background-repeat: no-repeat;
}
</style>
<link rel="stylesheet" type="text/css" href="assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.css">
</head>
<body>
<?php
  
   include("./connectdb.php");
   // $stmt = "SELECT PR_ref.prno,PR_ref.Vendor FROM PR_ref";
   $stmt = "SELECT * FROM coss_pr where coss_pr.pono is null";
           
   $query = sqlsrv_query($conn, $stmt);
 
?>

<?php

while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
{
 
  //$stmt1 = "SELECT * FROM PXFB0010 WHERE refno='".$result["refno"]."'";
  $stmt1 = "SELECT * FROM PXFB0010 WHERE refno='".$result["refno"]."'";
     $query1 = sqlsrv_query($conn254, $stmt1);
     while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)) 
     {
      $update1 = "UPDATE Coss_PR SET Pono = '".$row['pono']."' WHERE refno = '".$result["refno"]."'";  
        sqlsrv_query($conn254, $update1);
     
      }
  }
 

?>
<!--  -->
<!--  -->


<?php
sqlsrv_close($conn);
?>

</body>

</html>
