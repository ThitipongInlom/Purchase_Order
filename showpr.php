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
   $stmt = "SELECT coss_pr.pono,PR_ref.prno, PR_ref.Vendor, PR_ref.Vendor_name, PR_ref.Dep_name, PR_ref.HdApprove, PR_ref.PRApprove, PR_ref.GMApprove, PR_ref.EFCApprove, PR.prdate, PR.refno, PR_ref.completed, PR_ref.chkre, PR_ref.HdApprove+' '+LEFT(PR_ref.HdApprove_Date,8) as HdApprove_Date,  PR_ref.PRApprove+' '+LEFT(PR_ref.PRApprove_Date,8) as PRApprove_Date,PR_ref.GMApprove+' '+ LEFT(PR_ref.GMApprove_Date,8) as GMApprove_Date,PR_ref.EFCApprove+' '+ LEFT(PR_ref.EFCApprove_date,8) as EFCApprove_date FROM pr
   LEFT JOIN PR_ref ON PR.prno = PR_ref.prno
   LEFT JOIN coss_pr ON PR.prno = coss_pr.prno
   WHERE pr.prno='".$pr."'";
   $query = sqlsrv_query($conn, $stmt);
 
?>

<table width="1500" class="table table-bordered table-sm table-hover table-striped" border="1">
  <tr>
  	<th width="91"> <div align="center">PR No. </div></th>
  	<th width="91"> <div align="center">PO No. </div></th>
  	<th width="91"> <div align="center">Ref No. </div></th>
    <th width="91"> <div align="center">Vendor </div></th>
    <th width="91"> <div align="center">Vendor Name </div></th>
    <th width="91"> <div align="center">Date PR </div></th>
    <th width="91"> <div align="center">Department </div></th>
    <th width="91"> <div align="center">HOD</div></th>
    <th width="91"> <div align="center">AC</div></th>
    <th width="91"> <div align="center">GM</div></th>
    <th width="91"> <div align="center">EFC</div></th>
    <th width="91"> <div align="center">Completed</div></th>
    <th width="91"> <div align="center">CHKRE</div></th>
    <!-- <th width="91"> <div align="center">Action</div></th> -->
  </tr>
<?php
while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["prno"];?></div></td>
    <td><div align="center"><?php echo $result["pono"];?></div></td>
    <td><div align="center"><?php echo $result["refno"];?></div></td>
    <td><div align="center"><?php echo $result["Vendor"];?></div></td>
    <td><div align="LEFT"><?php echo $result["Vendor_name"];?></div></td>
    <td><div align="center"><?php echo $result["prdate"];?></div></td>
    <td><div align="center"><?php echo $result["Dep_name"];?></div></td>
    <td><div align="center"><?php echo $result["HdApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["PRApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["GMApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["EFCApprove_date"];?></div></td>
    <td><div align="center"><?php echo $result["completed"];?></div></td>
    <td><div align="center"><?php echo $result["chkre"];?></div></td>
    <!-- <td><div align="center"><button class="btn btn-dark" onclick="opennewteb(this);" prno="<?php echo $result["prno"];?>">Detail</button></div></td> -->
    <!-- <td><div align="center"><button class="btn btn-sm btn-primary">Action</button></div></td> -->
  </tr>
<?php
}
?>
</table>
<?php
   $stmt1 = "SELECT * FROM pr_item WHERE pr_item.prno='".$pr."' order by seq asc";
   $query1 = sqlsrv_query($conn, $stmt1);
?>

<table width="1500" class="table table-bordered table-sm table-hover table-striped" border="1">
  <tr>
  	<!-- <th width="91"> <div align="center">PR No. </div></th> -->
  	<th width="91"> <div align="center">No.</div></th>
  	<th width="91"> <div align="center">Qty.</div></th>
    <th width="91"> <div align="center">No. </div></th>
    <th width="91"> <div align="center">Description</div></th>
    <th width="91"> <div align="center">Date PR </div></th>
    <th width="91"> <div align="center">Department </div></th>
    <th width="91"> <div align="center">HOD</div></th>
    <th width="91"> <div align="center">AC</div></th>
    <th width="91"> <div align="center">1</div></th>
   <!--  <th width="91"> <div align="center">GM</div></th>
    <th width="91"> <div align="center">EFC</div></th>
    <th width="91"> <div align="center">Completed</div></th>
    <th width="91"> <div align="center">CHKRE</div></th> -->
    <!-- <th width="91"> <div align="center">Action</div></th> -->
  </tr>
<?php
while($result1 = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC))
{
?>
  <tr>
    <!-- <td><div align="center"><?php echo $result1["st"];?></div></td> -->
   <td><div align="center"><?php echo $result1["seq"];?></div></td>
   <td><div align="center"><?php echo $result1["prqty"];?></div></td>
    <td><div align="center"><?php echo $result1["prdcode"];?></div></td>
    <td><div align="center"><?php echo pname($result1["prdcode"]);?></div></td>
    <td><div align="LEFT"><?php echo $result1["prprice_old"];?></div></td>
    <td><div align="center"><?php echo $result1["lastpurdate"];?></div></td>
    <td><div align="center"><?php echo $result1["prprice"];?></div></td>
    <td><div align="center"><?php echo $result1["usedate"];?></div></td>
    <td><div align="center"><?php echo $result1["iremark"];?></div></td>
    <!-- <td><div align="center"><?php echo $result["GMApprove_Date"];?></div></td>
    <td><div align="center"><?php echo $result["EFCApprove_date"];?></div></td>
    <td><div align="center"><?php echo $result["completed"];?></div></td>
    <td><div align="center"><?php echo $result["chkre"];?></div></td> -->
    <!-- <td><div align="center"><button class="btn btn-sm btn-primary">Action</button></div></td> -->
<?php
}
?>
</table>


<?php
sqlsrv_close($conn);
?>

</body>
<script type="text/javascript" src="assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script type="text/javascript">
    var opennewteb = function opennewteb(e) {
      console.log(e);
      var dataprno = $(e).attr('prno');
      var urlopen = 'detialpr.php?prno='+dataprno+'';
      window.open(urlopen,'','width=500,height=500');
    }
</script>
</html>
