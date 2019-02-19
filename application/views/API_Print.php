<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->lang->line('titlev'); echo ' '.$this->lang->line('numberv'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive1.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive2.css'; ?>">
    <!-- Css Modifly -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css_modifly/css_show_all.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print()">
  <?php
  function namewarecode($warecode)
  {
  $CI =& get_instance();
  $beta = $CI->load->database('bo', TRUE);
  $query = $beta->get_where('STFC0070', array('warecode' => $warecode));
  $result = $query->result_array();
  $waredesc1 = $result[0]['waredesc1'];
  return $waredesc1;
  }

  $Newdate = nice_date($data_head[0]['prdate'], 'd/m/Y');
echo'<div id="dispayopendata2"><div class="row">
    <div class="col-md-12 col-xs-12">
        <div align="center">
          <img src="'.base_url().'assets/icon/wayhotel.png'.'" width="100">
        </div>
    </div>
    <div class="col-md-12 col-xs-12">
      <p align="center"><b>Division: '.$data_head[0]['div'].'</b></p>
    </div>
    <div class="col-md-12 col-xs-12">
      <p class="pull-left"><b>Vendor: </b> '.$data_head[0]['Vendor'].' - '.$data_head[0]['Vendor_name'].'</p>
      <p class="pull-right"><b>P/R No: </b> '.$data_head[0]['prno'].'</p>
       <input type="hidden" id="prapproveset" value="'.$data_head[0]['prno'].'">
    </div>
    <br>
    <div class="col-md-12 col-xs-12">
      <p class="pull-left"><b>No: </b> '.$data_head[0]['refno'].'</p>
      <p class="pull-right"><b>Warehouse: </b> ['.$data_head[0]['warecode'].'] '.namewarecode($data_head[0]['warecode']).'</p>
    </div>
    <br>
    <div class="col-md-12 col-xs-12">
      <p class="pull-left"><b>Date: </b> '.$Newdate.'</p>
      <p class="pull-right"><b>Department: </b> ['.$data_head[0]['dep'].'] '.$data_head[0]['Dep_name'].'</p>
    </div>
    <br>
    <div class="col-md-9 col-xs-9">
      <p class="pull-left"><b>Remark: </b> '.$data_head[0]['remark'].'</p>
    </div>
    <div class="col-md-3 col-xs-3">
      <p class="pull-right"><b>Purchase Requistion</b></p>
    </div>
    <br>
    <div class="col-md-12 col-xs-12">
      <div class="table-responsive">
        <table  width="100%" class="table table-bordered table-condensed  table-striped">
          <tr style="background:#D5DBDB;">
            <th width="6%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Qty/Unit</b></th>

            <th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>No.</b></th>
            <th width="55%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Description</b></th>
            <th width="10%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Delivery Date</b></th>
            <th width="20%" colspan="2" style="text-align: center; vertical-align: middle;"><b>Last Purchase</b></th>
            <th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
            <th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Total</b></th>
          </tr>
          <tr style="background:#D5DBDB;">
            <th width="5%" style="text-align: center; vertical-align: middle;"><b>Date</b></th>
            <th width="5%" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
          </tr>';
          $i = 1;
          foreach ($data_body as $row)
          {
          $i++;
          echo '<tr>
            <td style="text-align: center;">'; $warecode = $row['prdcode']; $betaware = $this->Get_data_model->getUniten($warecode); echo $row['prqty'].' '. $betaware.'</td>
            <td style="text-align: center;">';if ($row['ifileupd']!='') {
                echo '<div align="center"><i class="fa fa-paperclip" id="iconimg" imgdata="'.$row['ifileupd'].'" onclick="openwindowimg(this)"></i></div>';
            } echo $row['prdcode'].'</td>
            <td style="text-align: left;">';$warecode = $row['prdcode']; $iremark = $this->Get_data_model->iremark($warecode); $ciremark = $row['iremark'];  echo $iremark[0]['stname1']; if ($row['iremark'] != '') {
                echo '[* '.$ciremark.' *]';
            } echo'</td>
            <td style="text-align: center;">';$Newdate = nice_date($row['usedate'], 'd/m/Y'); echo $Newdate.'</td>
            <td style="text-align: center;">';if ($row['lastpurdate'] =='new') {
                echo 'New Item';
              }else{
                $lastpurdate = nice_date($row['lastpurdate'], 'd/m/Y'); echo $lastpurdate;
            } echo'</td>
            <td style="text-align: right;">'.number_format($row['prprice_old'],2).'฿</td>
            <td style="text-align: right;">'.number_format($row['prprice'],2).'฿</td>
            <td style="text-align: right;">'; $totalpice = $row['prprice'] * $row['prqty']; echo number_format($totalpice,2); echo'฿</td>
          </tr>';
          }
        echo'
          <tr style="background:#D5DBDB;">
            <td style="text-align: center;"><b>รายการ:</b>'; echo $i-1;  echo'</td>
            <td colspan="6" style="text-align: right;"><b>Total</b></td>
            <td>'; $totalget = $this->Get_data_model->gettotal($data_head[0]['prno']); echo number_format($totalget,2).'฿'; echo'</td>
          </tr>';
          if ($data_head[0]['DC']>0) {
            $dispersen = $data_head[0]['DC'];
            echo '<tr style="background:#D5DBDB;">
              <td colspan="7" style="text-align: right;"><b>Discount '.$dispersen.'%</b></td>
              <td>';$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);$DC = $data_head[0]['DC']; $DV_V = ($DC*$totalget)/100;  echo number_format($DV_V,2).'฿'; echo'</td>
            </tr>';
            }
          if ($data_head[0]['DC_A']>0) {
            echo '<tr style="background:#D5DBDB;">
              <td colspan="7" style="text-align: right;"><b>Discount</b></td>
              <td>';$DV_V = $data_head[0]['DC_A'];  echo number_format($DV_V,2).'฿'; echo'</td>
            </tr>';
            }
            if ($data_head[0]['Vat']=='Y') {
  						echo '<tr style="background:#D5DBDB;">
  							<td colspan="7" style="text-align: right;"><b>Vat 7%</b></td>
  							<td>';
  								$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
  								if ($data_head[0]['DC_A']>0) {
  									$DV_VD = $data_head[0]['DC_A'];
  								}else{
                    $DV_VD = 0;
                  }
  								if($data_head[0]['DC']>0){
  									$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
  									$DC = $data_head[0]['DC'];
  									$DV_VA = (($DC*$totalget)/100);
  								}else{
  									$DV_VA = 0;
  								}
  								$vata = (7/100)*($totalget - $DV_VA - $DV_VD);
  								echo number_format($vata,2).'';
  							echo'</td>
  						</tr>';
  					}
  					if ($data_head[0]['Vat']=='Y' OR $data_head[0]['DC_A']>0 OR $data_head[0]['DC']>0) {
  						echo '<tr style="background:#D5DBDB;">
  							<td colspan="7" style="text-align: right;"><b>Grand Total</b></td>
  							<td>';
  								if ($data_head[0]['DC_A']>0) {
  									$DV_VD = $data_head[0]['DC_A'];
  								}else{
                    $DV_VD = 0;
                  }
  								if($data_head[0]['DC']>0){
  									$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
  									$DC = $data_head[0]['DC'];
  									$DV_V = (($DC*$totalget)/100);
  								}else{
  									$DV_V = 0;
  								}
  								if ($data_head[0]['Vat']=='Y') {
  									$this->Get_data_model->gettotal($data_head[0]['prno']);
  									$newtotl = $totalget-$DV_V-$DV_VD;
  									$vata = ($newtotl/100)*7;
  								}elseif($data_head[0]['Vat']=='N'){
  									$vata = 0;
  								}
  							$totalget = $gtotal = (($totalget-$DV_V-$DV_VD)+$vata); echo number_format($gtotal,2).'';  echo'</td>
  						</tr>';
  					}
        echo'</table>';
        $GMcomment =  $data_head[0]['GMComment'];
        $EFCcomment = $data_head[0]['EFCComment'];
        if ($GMcomment !='') {
          echo '<b>GM Comment:</b>'.$GMcomment.'<br>';
        }
        if ($EFCcomment !='') {
          echo '<b>EFC Comment:</b>'.$EFCcomment.'<br>';
        }
      echo'</div></div></div>';
      $userhodapp = $data_head[0]['Hd_signature'];
      echo '<div class="row"><div class="col-md-12"><table width="100%"><tr align="center"><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
        if ($data_head[0]['HdApprove'] =='Y') {
        $dep = $data_head[0]['dep'];
          if ($dep=='HK01') {
            $dep ='HK01';
          }elseif($dep=='FO01'){
            $dep ='FO01';
          }elseif ($dep =='HK01' OR $dep =='FO01') {
            $dep ='RM';
          }
          $resultimg = $this->Get_data_model->Getimg_hod($userhodapp);
          if ($userhodapp=='') {
            echo '<img src="../../assets/signature/wit.gif" width="100">';
          }else{
            if ($resultimg[0]['signature_img'] == '') {
            echo '<img src="../../assets/signature/'.$dep.'.gif" width="80">';
            }else{
            echo '<img src="../../assets/signature/'.$resultimg[0]['signature_img'].'" width="80">';
            }
          }

        }else{
            echo '...............................';
        }
        echo '</td><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
      if ($data_head[0]['GMApprove'] =='Y') {
        echo '<img src="../../assets/signature/pichayaluk.gif" width="100">';
      }else{
        echo '..............................';
      }
    echo '</td><td>';
    if ($data_head[0]['EFCApprove'] =='Y') {
      echo '<img src="../../assets/signature/nitis.gif" width="100">';
    }else{
      echo '........................................';
    }
      echo '</td></tr><tr align="center"><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
  if ($data_head[0]['HdApprove'] =='Y') {
    if (isset($resultimg[0]['signature_img'])) {
      echo $resultimg[0]['fname'].' '.$resultimg[0]['lname'].'<br>';
    }
    $HdApprove_Date = nice_date($data_head[0]['HdApprove_Date'], 'd/m/Y h:i'); echo $HdApprove_Date;
  }
    echo '</td><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
  if ($data_head[0]['GMApprove'] =='Y') {
    $GMApprove_Date = nice_date($data_head[0]['GMApprove_Date'], 'd/m/Y h:i'); echo $GMApprove_Date;
  }
    echo '</td><td>';
  if ($data_head[0]['EFCApprove'] =='Y') {
    $EFCApprove = nice_date($data_head[0]['EFCApprove_Date'], 'd/m/Y h:i'); echo $EFCApprove;
  }
  echo '</td></tr><tr align="center"><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
    echo 'Department Head';
  echo '</td><td align="';
      if ($userhodapp=='') {
        echo 'right';
      }else{
        echo 'center';
      }
      echo'">';
    echo 'Chief Accountan';
    echo '</td><td>';
    echo 'General Manager';
  echo '</td></table></div></div></div>';
  ?>
  </body>
    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive1.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive2.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive3.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive4.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <!-- JS Modal  -->
    <script src="<?php echo base_url().'/assets/js_modifly/modal_show_all.js'; ?>"></script>
</html>
