<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Easy set variables
*/
 
/* Array of database columns which should be read and sent back to DataTables. Use a space where
* you want to insert a non-database field (for example a counter or static image)
*/
// add your columns here!!!
$aColumns = array( 'prno', 'prdate' );
 
/* MSSQL Database infomation */
$host = 'localhost';
$connectionInfo = array("Database"=>"PRA9", "UID"=>"sa", "PWD"=>"sa@thezign2013", "CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect($host,$connectionInfo);
if($conn){
 //echo "Connection Established";
}else{
 echo "Connection could not be Established";
 die ( 'Can not connect to server' );
}
 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "prdate";
 
/* DB table to use */
$sTable = "PR";
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* If you just want to use the basic configuration for DataTables with PHP server-side, there is
* no need to edit below this line
*/
 
/*
* Local functions
*/
function fatal_error ( $sErrorMessage = '' )
{
header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
die( $sErrorMessage );
}
 
 
/* Ordering */
$sOrder = "";
if ( isset( $_POST['order'] ) )
{
 $sOrder = "ORDER BY ";
 if ( $_POST['columns'][0]['orderable'] == "true" )
 {
 $sOrder .= "".$aColumns[ intval( $_POST['order'][0]['column'] ) ]." ".
 ($_POST['order'][0]['dir']==='asc' ? 'asc' : 'desc');
 }
}
 
/* escape function */
function mssql_escape($data) {
if(is_numeric($data))
return $data;
$unpacked = unpack('H*hex', $data);
return '0x' . $unpacked['hex'];
}
 
/* Filtering */
$sWhere = "";
if ( isset($_POST['search']['value']) && $_POST['search']['value'] != "" ) {
$sWhere = "WHERE (";
for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
$sWhere .= $aColumns[$i]." LIKE '%".addslashes( $_POST['search']['value'] )."%' OR ";
}
$sWhere = substr_replace( $sWhere, "", -3 );
$sWhere .= ')';
}
/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
if ( isset($_POST['columns'][$i]) && $_POST['columns'][$i]['searchable'] == "true" && $_POST['columns'][$i]['search']['value'] != '' ) {
if ( $sWhere == "" ) {
$sWhere = "WHERE ";
} else {
$sWhere .= " AND ";
}
$sWhere .= $aColumns[$i]." LIKE '%".addslashes($_POST['columns'][$i]['search']['value'])."%' ";
}
}
 
/* Paging */
$top = (isset($_POST['start']))?((int)$_POST['start']):0 ;
$limit = (isset($_POST['length']))?((int)$_POST['length'] ):5;
$sQuery = "SELECT TOP $limit ".implode(",",$aColumns)."
FROM $sTable
$sWhere ".(($sWhere=="")?" WHERE ":" AND ")." $sIndexColumn NOT IN
(
SELECT TOP $top $sIndexColumn FROM
$sTable $sOrder
)
$sOrder";
$rResult = sqlsrv_query($conn, $sQuery);
if($rResult === false){
 die(sqlsrv_errors(SQLSRV_ERR_ERRORS));
}
 
/* Data set length after filtering */
$sQueryCnt = "SELECT * FROM $sTable $sWhere";
$rResultCnt = sqlsrv_query($conn, $sQueryCnt );
$iFilteredTotal = sqlsrv_num_rows( $rResultCnt );
 
/* Total data set length */
$sQuery = "
SELECT COUNT(id)
FROM $sTable
";
$rResultTotal = sqlsrv_query($conn, $sQuery );
$aResultTotal = sqlsrv_fetch_array($rResultTotal, SQLSRV_FETCH_NUMERIC);

$iTotal = $aResultTotal[0];
 
 
/* Output */
$output = array(
"draw" => intval($_POST['draw']),
"recordsTotal" => $iTotal,
"recordsFiltered" => $iFilteredTotal,
"data" => array()
);
 
 
while ( $aRow = sqlsrv_fetch_array( $rResult, SQLSRV_FETCH_ASSOC) )
{
 $row = array();
 for ( $i=0 ; $i<count($aColumns) ; $i++ )
 {
 /* General output */
 $row[$aColumns[$i]] = $aRow[ $aColumns[$i] ];
 }
 $output['data'][] = $row;
}
 
echo json_encode( $output );
 
?>