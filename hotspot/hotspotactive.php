<?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
// hide all error
error_reporting(0);
if (!isset($_SESSION["mikhmon"])) {
	header("Location:../admin.php?id=login");
} else {

// load session MikroTik
	$session = $_GET['session'];
	$serveractive = $_GET['server'];

// load config
	include('../include/config.php');
	include('../include/readcfg.php');
	
// lang
  include('../include/lang.php');
  include('../lang/'.$langid.'.php');

// routeros api
	include_once('../lib/routeros_api.class.php');
	include_once('../lib/formatbytesbites.php');
	$API = new RouterosAPI();
	$API->debug = false;
	$API->connect($iphost, $userhost, decrypt($passwdhost));

	if ($serveractive != "") {
		$gethotspotactive = $API->comm("/ip/hotspot/active/print", array("?server" => "" . $serveractive . ""));
		$TotalReg = count($gethotspotactive);

		$counthotspotactive = $API->comm("/ip/hotspot/active/print", array(
			"count-only" => "", "?server" => "" . $serveractive . ""
		));

	} else {
		$gethotspotactive = $API->comm("/ip/hotspot/active/print");
		$TotalReg = count($gethotspotactive);

		$counthotspotactive = $API->comm("/ip/hotspot/active/print", array(
			"count-only" => "",
		));
	}
}
?>
<div class="row">
<div id="reloadHotspotActive">
<div class="col-12">
	<div class="card">
		<div class="card-header">
    		<h3><i class="fa fa-wifi"></i> <?= $_hotspot_active ?> <?php
				if ($serveractive == "") {
				} else {
					echo $serveractive . " ";
				}
				if ($counthotspotactive < 2) {
					echo "$counthotspotactive item";
				} elseif ($counthotspotactive > 1) {
					echo "$counthotspotactive items";
				};
				if ($serveractive == "") {
				} else {
					echo " | <a href='./?hotspot=active&session=" . $session . "'> <i class='fa fa-search'></i> Show all</a>";
				}
				?>			</h3>
        </div><?php
/*
 *  Copyright (C) 2018 Laksamadi Guko.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
session_start();
// hide all error
error_reporting(0);
if (!isset($_SESSION["mikhmon"])) {
  header("Location:../admin.php?id=login");
} else {

$rsj = $API->comm("/interface/print");  //
		$rsjt = $rsj['11']; //
		$rara = $rsjt['tx-byte']; //
		$uploadall = formatBytes(($rara), 2);
		$raras = $rsjt['rx-byte']; //
		$downloadall = formatBytes(($raras), 2);
		$rt = (($rara)+($raras));
		$realtotal = floor(($rt)/1048576);
		$realtotalx = formatBytes(($rt), 2);
		
  $a = $API->comm("/queue/simple/print");
  $aa= $a[22];
  $aaa= $aa['total-bytes'];
  $wifi = formatBytes(($aaa), 2);
  $wifie = $aa['total-rate'];
  $wifif = formatBites($wifie);
  
  $b = $API->comm("/queue/simple/print");
  $bb= $b[0];
  $bbb= $bb['total-bytes'];
  $semua = formatBytes(($bbb), 2);
  $semuamb = floor(($bbb)/1048576);
  $semuambb = floor(($bbb)/1048576*1.048576);
  
  $warnet = formatBytes(($rt)-($aaa), 2);
  
  $pc1 = $API->comm("/queue/simple/print");
  $pc1a= $pc1[1];
  $pc1b= $pc1a['total-bytes'];
  $pc1c = formatBytes(($pc1b), 2);
  $pc1d = floor(($pc1b)/1048576);
  $pc1e = $pc1a['total-rate'];
  $pc1f = formatBites($pc1e);

  $pc3 = $API->comm("/queue/simple/print");
  $pc3a= $pc3[2];
  $pc3b= $pc3a['total-bytes'];
  $pc3c = formatBytes(($pc3b), 2);
  $pc3d = floor(($pc3b)/1048576);
  $pc3e = $pc3a['total-rate'];
  $pc3f = formatBites($pc3e);
  
  $pc5 = $API->comm("/queue/simple/print");
  $pc5a= $pc5[3];
  $pc5b= $pc5a['total-bytes'];
  $pc5c = formatBytes(($pc5b), 2);
  $pc5d = floor(($pc5b)/1048576);
  $pc5e = $pc5a['total-rate'];
  $pc5f = formatBites($pc5e);
  
  $pc10 = $API->comm("/queue/simple/print");
  $pc10a= $pc10[4];
  $pc10b= $pc10a['total-bytes'];
  $pc10c = formatBytes(($pc10b), 2);
  $pc10d = floor(($pc10b)/1048576);
  $pc10e = $pc10a['total-rate'];
  $pc10f = formatBites($pc10e);
  
  $pc11 = $API->comm("/queue/simple/print");
  $pc11a= $pc11[5];
  $pc11b= $pc11a['total-bytes'];
  $pc11c = formatBytes(($pc11b), 2);
  $pc11d = floor(($pc11b)/1048576);
  $pc11e = $pc11a['total-rate'];
  $pc11f = formatBites($pc11e);
  
  $pc12 = $API->comm("/queue/simple/print");
  $pc12a= $pc12[6];
  $pc12b= $pc12a['total-bytes'];
  $pc12c = formatBytes(($pc12b), 2);
  $pc12d = floor(($pc12b)/1048576);
  $pc12e = $pc12a['total-rate'];
  $pc12f = formatBites($pc12e);
  
  $pc13 = $API->comm("/queue/simple/print");
  $pc13a= $pc13[7];
  $pc13b= $pc13a['total-bytes'];
  $pc13c = formatBytes(($pc13b), 2);
  $pc13d = floor(($pc13b)/1048576);
  $pc13e = $pc13a['total-rate'];
  $pc13f = formatBites($pc13e);
  
  $pc14 = $API->comm("/queue/simple/print");
  $pc14a= $pc14[8];
  $pc14b= $pc14a['total-bytes'];
  $pc14c = formatBytes(($pc14b), 2);
  $pc14d = floor(($pc14b)/1048576);
  $pc14e = $pc14a['total-rate'];
  $pc14f = formatBites($pc14e);
  
  $pc15 = $API->comm("/queue/simple/print");
  $pc15a= $pc15[9];
  $pc15b= $pc15a['total-bytes'];
  $pc15c = formatBytes(($pc15b), 2);
  $pc15d = floor(($pc15b)/1048576);
  $pc15e = $pc15a['total-rate'];
  $pc15f = formatBites($pc15e);
  
  $pc16 = $API->comm("/queue/simple/print");
  $pc16a= $pc16[10];
  $pc16b= $pc16a['total-bytes'];
  $pc16c = formatBytes(($pc16b), 2);
  $pc16d = floor(($pc16b)/1048576);
  $pc16e = $pc16a['total-rate'];
  $pc16f = formatBites($pc16e);
  
  $pc17 = $API->comm("/queue/simple/print");
  $pc17a= $pc17[11];
  $pc17b= $pc17a['total-bytes'];
  $pc17c = formatBytes(($pc17b), 2);
  $pc17d = floor(($pc17b)/1048576);
  $pc17e = $pc17a['total-rate'];
  $pc17f = formatBites($pc17e);
  
  $pc18 = $API->comm("/queue/simple/print");
  $pc18a= $pc18[12];
  $pc18b= $pc18a['total-bytes'];
  $pc18c = formatBytes(($pc18b), 2);
  $pc18d = floor(($pc18b)/1048576);
  $pc18e = $pc18a['total-rate'];
  $pc18f = formatBites($pc18e);
  
  $pc19 = $API->comm("/queue/simple/print");
  $pc19a= $pc19[13];
  $pc19b= $pc19a['total-bytes'];
  $pc19c = formatBytes(($pc19b), 2);
  $pc19d = floor(($pc19b)/1048576);
  $pc19e = $pc19a['total-rate'];
  $pc19f = formatBites($pc19e);
  
  $pc20 = $API->comm("/queue/simple/print");
  $pc20a= $pc20[14];
  $pc20b= $pc20a['total-bytes'];
  $pc20c = formatBytes(($pc20b), 2);
  $pc20d = floor(($pc20b)/1048576);
  $pc20e = $pc20a['total-rate'];
  $pc20f = formatBites($pc20e);
  
  $pc21 = $API->comm("/queue/simple/print");
  $pc21a= $pc21[15];
  $pc21b= $pc21a['total-bytes'];
  $pc21c = formatBytes(($pc21b), 2);
  $pc21d = floor(($pc21b)/1048576);
  $pc21e = $pc21a['total-rate'];
  $pc21f = formatBites($pc21e);
  
  $pc22 = $API->comm("/queue/simple/print");
  $pc22a= $pc22[16];
  $pc22b= $pc22a['total-bytes'];
  $pc22c = formatBytes(($pc22b), 2);
  $pc22d = floor(($pc22b)/1048576);
  $pc22e = $pc22a['total-rate'];
  $pc22f = formatBites($pc22e);
  
  $pc23 = $API->comm("/queue/simple/print");
  $pc23a= $pc23[17];
  $pc23b= $pc23a['total-bytes'];
  $pc23c = formatBytes(($pc23b), 2);
  $pc23d = floor(($pc23b)/1048576);
  $pc23e = $pc23a['total-rate'];
  $pc23f = formatBites($pc23e);
  
  $pc24 = $API->comm("/queue/simple/print");
  $pc24a= $pc24[18];
  $pc24b= $pc24a['total-bytes'];
  $pc24c = formatBytes(($pc24b), 2);
  $pc24d = floor(($pc24b)/1048576);
  $pc24e = $pc24a['total-rate'];
  $pc24f = formatBites($pc24e);
  
  $pc25 = $API->comm("/queue/simple/print");
  $pc25a= $pc25[19];
  $pc25b= $pc25a['total-bytes'];
  $pc25c = formatBytes(($pc25b), 2);
  $pc25d = floor(($pc25b)/1048576);
  $pc25e = $pc25a['total-rate'];
  $pc25f = formatBites($pc25e);
  
  $server = $API->comm("/queue/simple/print");
  $servera= $server[20];
  $serverb= $servera['total-bytes'];
  $serverc = formatBytes(($serverb), 2);
  $serverd = floor(($serverb)/1048576);
  $servere = $servera['total-rate'];
  $serverf = formatBites($servere);
  
  $kkj = $API->comm("/interface/monitor-traffic", array("interface" => "0INDIHOME", "once" => "",));
		$ruru = $kkj[0]['tx-bits-per-second']; //
		$muyak = formatBites(($ruru), 2);
		$rere = $kkj[0]['rx-bits-per-second']; //
		$mayuk = formatBites(($rere), 2);	
		
$ipc = $API->comm("/ip/address/print");  //cek ip terbaik
		$ipr = $ipc['7']; //
		$ip = $ipr['address']; //
		

		
// get MikroTik system clock
  $getclock = $API->comm("/system/clock/print");
  $clock = $getclock[0];
  $timezone = $getclock[0]['time-zone-name'];
  $_SESSION['timezone'] = $timezone;
  date_default_timezone_set($timezone);

// get system resource MikroTik
  $getresource = $API->comm("/system/resource/print");
  $resource = $getresource[0];

// get routeboard info
  $getrouterboard = $API->comm("/system/routerboard/print");
  $routerboard = $getrouterboard[0];
/*
// move hotspot log to disk *
  $getlogging = $API->comm("/system/logging/print", array("?prefix" => "->", ));
  $logging = $getlogging[0];
  if ($logging['prefix'] == "->") {
  } else {
    $API->comm("/system/logging/add", array("action" => "disk", "prefix" => "->", "topics" => "hotspot,info,debug", ));
  }

// get hotspot log
  $getlog = $API->comm("/log/print", array("?topics" => "hotspot,info,debug", ));
  $log = array_reverse($getlog);
  $THotspotLog = count($getlog);
*/
// get & counting hotspot users
  $countallusers = $API->comm("/ip/hotspot/user/print", array("count-only" => ""));
  if ($countallusers < 2) {
    $uunit = "item";
  } elseif ($countallusers > 1) {
    $uunit = "items";
  }

// get & counting hotspot active
  $counthotspotactive = $API->comm("/ip/hotspot/active/print", array("count-only" => ""));
  if ($counthotspotactive < 2) {
    $hunit = "item";
  } elseif ($counthotspotactive > 1) {
    $hunit = "items";
  }

  if ($livereport == "disable") {
    $logh = "457px";
    $lreport = "style='display:none;'";
  } else {
    $logh = "350px";
    $lreport = "style='display:block;'";
  }
  
/*
// get selling report
    $thisD = date("d");
    $thisM = strtolower(date("M"));
    $thisY = date("Y");

    if (strlen($thisD) == 1) {
      $thisD = "0" . $thisD;
    } else {
      $thisD = $thisD;
    }

    $idhr = $thisM . "/" . $thisD . "/" . $thisY;
    $idbl = $thisM . $thisY;

    $getSRHr = $API->comm("/system/script/print", array(
      "?source" => "$idhr",
    ));
    $TotalRHr = count($getSRHr);
    $getSRBl = $API->comm("/system/script/print", array(
      "?owner" => "$idbl",
    ));
    $TotalRBl = count($getSRBl);

    for ($i = 0; $i < $TotalRHr; $i++) {

      $tHr += explode("-|-", $getSRHr[$i]['name'])[3];

    }
    for ($i = 0; $i < $TotalRBl; $i++) {

      $tBl += explode("-|-", $getSRBl[$i]['name'])[3];
    }
  }*/
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengenal Tabel HTML</title>
</head>
<body>
    <table height=100px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
        <tr>
            <td bgcolor="orange"style='text-align:center;'><b>No-PC<b></td> 
            <td bgcolor="orange" style='text-align:center;'><b>Total-Bytes<b></td>
			<td bgcolor="orange" style='text-align:center;'><b>Total-Rate<b></td>
        </tr>
        <tr>
            <td bgcolor=<?php if($pc1d > "0"){ echo $bgcolor = "white"; }elseif($pc1d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>1<b></td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc1d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc1f."
                      " . $x['hapus']; 
                    ?></td>
        </tr>
			<td bgcolor=<?php if($pc3d > "0"){ echo $bgcolor = "white"; }elseif($pc3d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>3<b></td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc3d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc3f."
                      " . $x['hapus']; 
                    ?></td>
		 </tr>
			<td bgcolor=<?php if($pc5d > "0"){ echo $bgcolor = "white"; }elseif($pc5d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>5<b></td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc5d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc5f."
                      " . $x['hapus']; 
                    ?></td>		
        <tr>
            <td bgcolor=<?php if($pc10d > "0"){ echo $bgcolor = "white"; }elseif($pc10d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>10<b></td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc10d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc10f."
                      " . $x['hapus']; 
                    ?></td>
        </tr>
			<td bgcolor=<?php if($pc11d > "0"){ echo $bgcolor = "white"; }elseif($pc11d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>11<b></td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc11d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc11f."
                      " . $x['hapus']; 
                    ?></td>
		 </tr>
			<td bgcolor=<?php if($pc12d > "0"){ echo $bgcolor = "white"; }elseif($pc12d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>12</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc12d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc12f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc13d > "0"){ echo $bgcolor = "white"; }elseif($pc13d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>13</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc13d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc13f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc14d > "0"){ echo $bgcolor = "white"; }elseif($pc14d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>14</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc14d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc14f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc15d > "0"){ echo $bgcolor = "white"; }elseif($pc15d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>15</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc15d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc15f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc16d > "0"){ echo $bgcolor = "white"; }elseif($pc16d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>16</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc16d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc16f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc17d > "0"){ echo $bgcolor = "white"; }elseif($pc17d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>17</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc17d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc17f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc18d > "0"){ echo $bgcolor = "white"; }elseif($pc18d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>18</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc18d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc18f."
                      " . $x['hapus']; 
                    ?></td>			
        <tr>
            <td bgcolor=<?php if($pc19d > "0"){ echo $bgcolor = "white"; }elseif($pc19d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>19</td>
           <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc19d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc19f."
                      " . $x['hapus']; 
                    ?></td>
        </tr>
			<td bgcolor=<?php if($pc20d > "0"){ echo $bgcolor = "white"; }elseif($pc20d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>20</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc20d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc20f."
                      " . $x['hapus']; 
                    ?></td>
		 </tr>
			<td bgcolor=<?php if($pc21d > "0"){ echo $bgcolor = "white"; }elseif($pc21d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>21</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc21d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc21f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc22d > "0"){ echo $bgcolor = "white"; }elseif($pc22d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>22</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc22d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc22f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc23d > "0"){ echo $bgcolor = "white"; }elseif($pc23d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>23</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc23d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc23f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc24d > "0"){ echo $bgcolor = "white"; }elseif($pc24d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>24</td>
            <td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc24d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="#04ff00" style='text-align:center;color:black;'><?php 
                    echo "".$pc24f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc25d > "0"){ echo $bgcolor = "white"; }elseif($pc25d < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>25</td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc25d." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$pc25f."
                      " . $x['hapus']; 
                    ?></td>	
		
    </table>
			<table height=50px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
	
			<td bgcolor=<?php if($serverd > "0"){ echo $bgcolor = "orange"; }elseif($serverd < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>b<b></td>
            <td bgcolor="orange" style='text-align:center;color:black;'><?php 
                    echo "".$serverd." MiB 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="orange" style='text-align:center;color:black;'><?php 
                    echo "".$serverf."
                      " . $x['hapus']; 
                    ?></td>
		<tr>
            <td bgcolor="orange"style='text-align:center;'><i class="fa fa-laptop"> PC </i><b><td bgcolor="orange"style='text-align:center;'> <?php 
                    echo "".$warnet."
                      " . $x['hapus']; 
                    ?><b></td>	
	</table>				
</body>
</html> 
</table>
	<table height=200px width=100% border=1 cellpadding=0 cellspacing=5 align="left">	
		</tr>
			<td bgcolor="pink" style='text-align:center;color:black;'>Rate-Down-Up</td>
            <td bgcolor="pink" style='text-align:center;color:black;'><?php 
                    echo " ".$mayuk." - ".$muyak."
                      " . $x['hapus']; 
                    ?></td>			
					
		</tr>
			<td bgcolor="Cyan" style='text-align:center;color:black;'>Total-Down-Up</td>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><?php 
                    echo " ".$downloadall." - ".$uploadall."
                      " . $x['hapus']; 
                    ?></td>
				
		</tr>
			<td bgcolor="pink" style='text-align:center;color:black;'>Total-Bytes</td>
            <td bgcolor="pink" style='text-align:center;color:black;'><?php 
                    echo "".$realtotal." MiB / ".$realtotalx."
                      " . $x['hapus']; 
                    ?></td>
		
		</tr>
			<td bgcolor="Cyan" style='text-align:center;color:black;'>IP</td>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><?php 
                    echo "".$ip."
                      " . $x['hapus']; 
                    ?></td>	
        </tr>
			<td bgcolor="pink" style='text-align:center;color:black;'>Resource</td>
            <td bgcolor="pink" style='text-align:center;color:black;'><?php
                    echo $_cpu_load." : " . $resource['cpu-load'] . "%<br/>
                    ".$_free_memory." : " . formatBytes($resource['free-memory'], 2) . "<br/>
                    ".$_free_hdd." : " . formatBytes($resource['free-hdd-space'], 2)
                    ?></td>
		</tr>
			<td bgcolor="Cyan" style='text-align:center;color:black;'>Clock</td>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><?php 
                    echo ucfirst($clock['date']) . " " . $clock['time'] . "<br>
                    ".$_uptime." : " . formatDTM($resource['uptime']);
                    $_SESSION[$session.'sdate'] = $clock['date'];
                    ?></td>
    </table>
</body>
</html> 

</table>
	<table height=20px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
           <td bgcolor="Wheat" style='text-align:center;color:black;'><i class="fa fa-wifi"></i> WIFI <?php 
                    echo "".$wifi."
                      " . $x['hapus']; 
                    ?><i class="fa fa-wifi"></i> WIFI <?php 
                    echo "".$wifif."
                      " . $x['hapus'];  
                    ?></td>
	</table>
   

</div>
</div>
         <div class="card-body overflow">
<table height=100px width=100% id="tFilter" class="table table-bordered table-hover text-nowrap">
  <thead>
  <tr>
    <th bgcolor="orange" class="text-center"></th>
    <th bgcolor="orange" class="text-center">Server</th>
    <th bgcolor="orange" class="text-center">User</th>
    <th bgcolor="orange" class="text-center">Total</th>
    <th bgcolor="orange" class="text-center">Address</th>
    <th bgcolor="orange" class="text-center">Uptime</th>
    <th bgcolor="orange" class="text-center">Down</th>
    <th bgcolor="orange"class="text-center">Up</th>
    <th bgcolor="orange"class="text-center">Idle Time</th>
    <th bgcolor="orange"class="text-center">Login By</th>
    <th bgcolor="orange"class="text-center"><?= $_comment ?></th>
  </tr>
  </thead>
  <tbody>
<?php
for ($i = 0; $i < $TotalReg; $i++) {
	$hotspotactive = $gethotspotactive[$i];
	$id = $hotspotactive['.id'];
	$server = $hotspotactive['server'];
	$user = $hotspotactive['user'];
	$uptime = formatDTM($hotspotactive['uptime']);
	$idletime = formatDTM($hotspotactive['idle-time']);
	$bytesi = formatBytes($hotspotactive['bytes-in'], 2);
	$bytesy = $hotspotactive['bytes-in'];
	$byteso = formatBytes($hotspotactive['bytes-out'], 2);
	$bytesz = $hotspotactive['bytes-out'];
	$rrr = (($bytesy)+($bytesz));
    $byte = floor(($rrr)/1048576);
	$address = $hotspotactive['address'];	
	$loginby = $hotspotactive['login-by'];
	$comment = $hotspotactive['comment'];
	$uriprocess = "'./?remove-user-active=" . $id . "&session=" . $session . "'";
	echo "<tr>";
	echo "<td style='text-align:center;'><span class='pointer'  title='Remove " . $user . "' onclick=loadpage(".$uriprocess.")><i class='fa fa-minus-square text-danger'></i></span></td>";
	echo "<td style='text-align:center;'><a  title='filter " . $server . "' href='./?hotspot=active&server=" . $server . "&session=" . $session . "'><i class='fa fa-server'></i> " . $server . "</a></td>";
	echo "<td style='text-align:center;'><a title='Open User " . $user . "' href=./?hotspot-user=" . $user . "&session=" . $session . "><i class='fa fa-edit'></i> " . $user . "</a></td>";
	echo "<td style='text-align:right;'>" . $byte . " MiB</td>";
	echo "<td style='text-align:center;'>" . $address . " </td>";
	echo "<td style='text-align:center;'>" . $uptime . "</td>";
	echo "<td style='text-align:right;'>" . $byteso . "</td>";
	echo "<td style='text-align:right;'>" . $bytesi . "</td>";
	echo "<td style='text-align:center;'>" . $idletime . "</td>";
	echo "<td style='text-align:center;'>" . $loginby . "</td>";
	echo "<td style='text-align:left;'>" . $comment . "</td>";
	echo "</tr>";
}
?>
  </tbody>
</table>
</div>


</div>
</div>
</div>
</div>
