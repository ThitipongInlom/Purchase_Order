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
   $stmt = "SELECT PR.div, PR_ref.Vendor+' '+PR_ref.Vendor_name as Vendor,PR_ref.Dep_name, PR.refno, PR.prdate, PR.prno, PR_Item.prqty,
   PR_Item.prdcode, PR_Item.usedate, PR_Item.lastpurdate, PR_Item.prprice_old, PR_Item.prprice, PR_Item.iremark FROM pr 
   LEFT JOIN PR_ref ON PR.prno = PR_ref.prno
   LEFT JOIN PR_Item ON PR.prno = PR_Item.prno 

   WHERE PR_Item.prno IS NOT NULL and PR.prno= 'PR-0055902'"
;
   $query = sqlsrv_query($conn, $stmt);
// echo $stmt;

   function Beta($prno)
   {
   	// select

   	// return 
   }
?>
<table width="1500" class="table table-bordered table-sm table-hover table-striped" border="1">
  <tr>
  	<th width="91"> <div align="center">Division</div></th>
  	<th width="91"> <div align="center">Vendor</div></th>
  	<th width="91"> <div align="center">No.</div></th>
    <th width="91"> <div align="center">Date</div></th>
    <th width="91"> <div align="center">Remark</div></th>
    <th width="91"> <div align="center">P/R No.</div></th>
    <th width="91"> <div align="center">Department</div></th>
    <th width="91"> <div align="center">Unit</div></th>
    <th width="91"> <div align="center">Qty</div></th>
    <th width="91"> <div align="center">No.</div></th>
    <th width="91"> <div align="center">Delivery Date</div></th>
    <th width="91"> <div align="center">Last Date</div></th>
    <th width="91"> <div align="center">Last Unitprice</div></th>
    <th width="91"> <div align="center">Unitprice</div></th>
    <th width="91"> <div align="center">Action</div></th>
  </tr>
<?php
while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["div"];?></div></td>
    <td><div align="center"><?php echo $result["Vendor"];?></div></td>
    <td><div align="center"><?php echo $result["refno"];?></div></td>
    <td><div align="center"><?php echo $result["prdate"];?></div></td>
    <td><div align="LEFT"><?php echo $result["prno"];?></div></td>
    <td><div align="center"><?php echo $result["prdate"];?></div></td>
    <td><div align="center"><?php echo $result["Dep_name"];?></div></td>
    <!-- <td><div align="center"><?php echo $result["HdApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["PRApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["GMApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["EFCApprove_date"];?></div></td>
    <td><div align="center"><?php echo $result["completed"];?></div></td>
    <td><div align="center"><?php echo $result["chkre"];?></div></td>
    <td><div align="center"><button class="btn btn-dark" onclick="opennewteb(this);" prno="<?php echo $result["prno"];?>">Detail</button></div></td> -->
    <td><div align="center"><button class="btn btn-sm btn-primary">Action</button></div></td>
   	
  </tr>
<?php
}
?>
</table>
<!-- <?php
sqlsrv_close($conn);
?>  -->