<?php
	ini_set('display_errors', 1);
	error_reporting(~0);
	//echo $po;
   $serverName = "172.16.1.253";
   $userName = "sa";
   $userPassword = "sa@thezign2013";
   $dbName = "PRA";

	$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword,
			"MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

   $conn = sqlsrv_connect( $serverName, $connectionInfo);

   $serverName254 = "172.16.1.254\BO";
   $userName254 = "sa";
   $userPassword254 = "itmin@jupiter2013";
   $dbName254 = "Zign";

	$connectionInfo254 = array("Database"=>$dbName254, "UID"=>$userName254, "PWD"=>$userPassword254,
			"MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

   $conn254 = sqlsrv_connect( $serverName254, $connectionInfo254);


   function pname($code){
   $serverName = "172.16.1.253";
   $userName = "sa";
   $userPassword = "sa@thezign2013";
   $dbName = "PRA";

	$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword,
			"MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

   $conn = sqlsrv_connect( $serverName, $connectionInfo);

    $serverName254 = "172.16.1.254\BO";
   $userName254 = "sa";
   $userPassword254 = "itmin@jupiter2013";
   $dbName254 = "Zign";

	$connectionInfo254 = array("Database"=>$dbName254, "UID"=>$userName254, "PWD"=>$userPassword254,
			"MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

   $conn254 = sqlsrv_connect( $serverName254, $connectionInfo254);


	$stmt1 = "SELECT * FROM STFA0010 WHERE stcode='$code'";
	   $query1 = sqlsrv_query($conn254, $stmt1);
	   while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC)) {
	   $stname1 = $row['stname1'];
	   if ($stname1 != '') {
	   	$restname1 = $stname1;
	   }else{
	   	$restname1 = '';
	   }
	 }
	 return $restname1;
	}

?>
