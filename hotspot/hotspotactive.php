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
error_reporting(E_ALL && ~E_NOTICE);
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
		<div class="card-header"style='text-align:center;'>
    		<h3><i class="fa fa-laptop"></i> WARNET SELONGAN</h3>
        </div>
		
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

$rsj = $API->comm("/interface/print");  //
		$rsjt = $rsj['11']; //
		$rara = $rsjt['tx-byte']; //
		$uploadall = formatBytes(($rara), 2);
		$raras = $rsjt['rx-byte']; //
		$downloadall = formatBytes(($raras), 2);
		$rt = (($rara)+($raras));
		$realtotal = floor(($rt)/1048576);
		$realtotalx = formatBytes(($rt), 2);
		
  $wifi = $API->comm("/queue/simple/print");
  $wifib= $wifi[32];
  $wific= $wifib['total-bytes'];
  $wifid = formatBytes(($wific), 2); // jumlah wifi
  $wifie = $wifib['total-rate'];
  $wifif = formatBites(($wifie), 2); // kecepatan wifi
  
  $b = $API->comm("/queue/simple/print");
  $bb= $b[0];
  $bbb= $bb['total-bytes'];
  $semua = formatBytes(($bbb), 2);
  $semuamb = floor(($bbb)/1048576);
  $semuambb = floor(($bbb)/1048576*1.048576);
  $binrate = $bb['total-rate'];
  $binrates = formatBites(($binrate), 2); //kecepatan bin
  
  $wififff = formatBytes(($rt)-($bbb), 2); //jumlah wifi cara hitung : indihome - binding (cadangan)
  
  
  
  $kkj = $API->comm("/interface/monitor-traffic", array("interface" => "0INDIHOME", "once" => "",));
		$ruru = $kkj[0]['tx-bits-per-second']; //upload indihome
		$muyak = formatBites(($ruru), 2);
		$rere = $kkj[0]['rx-bits-per-second']; //download indihome
		$mayuk = formatBites(($rere), 2);	
	
	$tsm = formatBites((($binrate)+($wifie)), 2); //total speed mikrotik	
	$tsi = formatBites((($rere)+($ruru)), 2);	//total speed indihome
	$tss = formatBites(($binrate+wifie-$rere-$ruru)); //total selisih tsm dan tsi
	
	$tbm = formatBytes(($bbb)+($wific), 2); //total byte mikrotik
	$tbi = formatBytes(($raras)+($rara), 2); //total byte indihome
	$tbs = formatBytes(($bbb+$wific-$raras-$rara), 2); //total byte selisih
		
		
		
  $ipc = $API->comm("/ip/address/print");  //cek ip terbaik
		$ipr = $ipc['7']; //
		$ip = $ipr['address']; //
  
  $pc1 = $API->comm("/queue/simple/print");
  $pc1a= $pc1[1];
  $pc1b= $pc1a['total-bytes'];
  $pc1c = formatBytes(($pc1b), 2);
  $pc1d = round((($pc1b)/1048576), 2);
  $pc1e = $pc1a['total-rate'];
  $pc1f = formatBites($pc1e);

  $pc3 = $API->comm("/queue/simple/print");
  $pc3a= $pc3[2];
  $pc3b= $pc3a['total-bytes'];
  $pc3c = formatBytes(($pc3b), 2);
  $pc3d = round((($pc3b)/1048576), 2);
  $pc3e = $pc3a['total-rate'];
  $pc3f = formatBites($pc3e);
  
  $pc5 = $API->comm("/queue/simple/print");
  $pc5a= $pc5[3];
  $pc5b= $pc5a['total-bytes'];
  $pc5c = formatBytes(($pc5b), 2);
  $pc5d = round((($pc5b)/1048576), 2);
  $pc5e = $pc5a['total-rate'];
  $pc5f = formatBites($pc5e);
  
  $pc10 = $API->comm("/queue/simple/print");
  $pc10a= $pc10[4];
  $pc10b= $pc10a['total-bytes'];
  $pc10c = formatBytes(($pc10b), 2);
  $pc10d = round((($pc10b)/1048576), 2);
  $pc10e = $pc10a['total-rate'];
  $pc10f = formatBites($pc10e);
  
  $pc11 = $API->comm("/queue/simple/print");
  $pc11a= $pc11[5];
  $pc11b= $pc11a['total-bytes'];
  $pc11c = formatBytes(($pc11b), 2);
  $pc11d = round((($pc11b)/1048576), 2);
  $pc11e = $pc11a['total-rate'];
  $pc11f = formatBites($pc11e);
  
  $pc12 = $API->comm("/queue/simple/print");
  $pc12a= $pc12[6];
  $pc12b= $pc12a['total-bytes'];
  $pc12c = formatBytes(($pc12b), 2);
  $pc12d = round((($pc12b)/1048576), 2);
  $pc12e = $pc12a['total-rate'];
  $pc12f = formatBites($pc12e);
  
  $pc13 = $API->comm("/queue/simple/print");
  $pc13a= $pc13[7];
  $pc13b= $pc13a['total-bytes'];
  $pc13c = formatBytes(($pc13b), 2);
  $pc13d = round((($pc13b)/1048576), 2);
  $pc13e = $pc13a['total-rate'];
  $pc13f = formatBites($pc13e);
  
  $pc14 = $API->comm("/queue/simple/print");
  $pc14a= $pc14[8];
  $pc14b= $pc14a['total-bytes'];
  $pc14c = formatBytes(($pc14b), 2);
  $pc14d = round((($pc14b)/1048576), 2);
  $pc14e = $pc14a['total-rate'];
  $pc14f = formatBites($pc14e);
  
  $pc15 = $API->comm("/queue/simple/print");
  $pc15a= $pc15[9];
  $pc15b= $pc15a['total-bytes'];
  $pc15c = formatBytes(($pc15b), 2);
  $pc15d = round((($pc15b)/1048576), 2);
  $pc15e = $pc15a['total-rate'];
  $pc15f = formatBites($pc15e);
  
  $pc16 = $API->comm("/queue/simple/print");
  $pc16a= $pc16[10];
  $pc16b= $pc16a['total-bytes'];
  $pc16c = formatBytes(($pc16b), 2);
  $pc16d = round((($pc16b)/1048576), 2);
  $pc16e = $pc16a['total-rate'];
  $pc16f = formatBites($pc16e);
  
  $pc17 = $API->comm("/queue/simple/print");
  $pc17a= $pc17[11];
  $pc17b= $pc17a['total-bytes'];
  $pc17c = formatBytes(($pc17b), 2);
  $pc17d = round((($pc17b)/1048576), 2);
  $pc17e = $pc17a['total-rate'];
  $pc17f = formatBites($pc17e);
  
  $pc18 = $API->comm("/queue/simple/print");
  $pc18a= $pc18[12];
  $pc18b= $pc18a['total-bytes'];
  $pc18c = formatBytes(($pc18b), 2);
  $pc18d = round((($pc18b)/1048576), 2);
  $pc18e = $pc18a['total-rate'];
  $pc18f = formatBites($pc18e);
  
  $pc19 = $API->comm("/queue/simple/print");
  $pc19a= $pc19[13];
  $pc19b= $pc19a['total-bytes'];
  $pc19c = formatBytes(($pc19b), 2);
  $pc19d = round((($pc19b)/1048576), 2);
  $pc19e = $pc19a['total-rate'];
  $pc19f = formatBites($pc19e);
  
  $pc20 = $API->comm("/queue/simple/print");
  $pc20a= $pc20[14];
  $pc20b= $pc20a['total-bytes'];
  $pc20c = formatBytes(($pc20b), 2);
  $pc20d = round((($pc20b)/1048576), 2);
  $pc20e = $pc20a['total-rate'];
  $pc20f = formatBites($pc20e);
  
  $pc21 = $API->comm("/queue/simple/print");
  $pc21a= $pc21[15];
  $pc21b= $pc21a['total-bytes'];
  $pc21c = formatBytes(($pc21b), 2);
  $pc21d = round((($pc21b)/1048576), 2);
  $pc21e = $pc21a['total-rate'];
  $pc21f = formatBites($pc21e);
  
  $pc22 = $API->comm("/queue/simple/print");
  $pc22a= $pc22[16];
  $pc22b= $pc22a['total-bytes'];
  $pc22c = formatBytes(($pc22b), 2);
  $pc22d = round((($pc22b)/1048576), 2);
  $pc22e = $pc22a['total-rate'];
  $pc22f = formatBites($pc22e);
  
  $pc23 = $API->comm("/queue/simple/print");
  $pc23a= $pc23[17];
  $pc23b= $pc23a['total-bytes'];
  $pc23c = formatBytes(($pc23b), 2);
  $pc23d = round((($pc23b)/1048576), 2);
  $pc23e = $pc23a['total-rate'];
  $pc23f = formatBites($pc23e);
  
  $pc24 = $API->comm("/queue/simple/print");
  $pc24a= $pc24[18];
  $pc24b= $pc24a['total-bytes'];
  $pc24c = formatBytes(($pc24b), 2);
  $pc24d = round((($pc24b)/1048576), 2);
  $pc24e = $pc24a['total-rate'];
  $pc24f = formatBites($pc24e);
  
  $pc25 = $API->comm("/queue/simple/print");
  $pc25a= $pc25[19];
  $pc25b= $pc25a['total-bytes'];
  $pc25c = formatBytes(($pc25b), 2);
  $pc25d = round((($pc25b)/1048576), 2);
  $pc25e = $pc25a['total-rate'];
  $pc25f = formatBites($pc25e);
  
  $server = $API->comm("/queue/simple/print");
  $servera= $server[20];
  $serverb= $servera['total-bytes'];
  $serverc = formatBytes(($serverb), 2);
  $serverd = round((($serverb)/1048576), 2);
  $servere = $servera['total-rate'];
  $serverf = formatBites($servere);
  
  $mama = $API->comm("/queue/simple/print");
  $mamaa= $mama[22];
  $mamab= $mamaa['total-bytes'];
  $mamac = formatBytes(($mamab), 2);
  $mamad = round((($mamab)/1048576), 2);
  $mamae = $mamaa['total-rate'];
  $mamaf = formatBites($mamae);
  
  $kaka = $API->comm("/queue/simple/print");
  $kakaa= $kaka[23];
  $kakab= $kakaa['total-bytes'];
  $kakac = formatBytes(($kakab), 2);
  $kakad = round((($kakab)/1048576), 2);
  $kakae = $kakaa['total-rate'];
  $kakaf = formatBites($kakae);
  
  $cctv = $API->comm("/queue/simple/print");  //cctv
  $cctv1= $cctv[25];
  $cctv2 = $cctv1['total-rate'];
  
  $apmama = $API->comm("/queue/simple/print");  //apmama
  $apmama1= $apmama[26];
  $apmama2 = $apmama1['total-rate'];
  
  $apwifia = $API->comm("/queue/simple/print");  //apwifi1
  $apwifi1= $apwifia[27];
  $apwifi11 = $apwifi1['total-rate'];
  
  $apwifib = $API->comm("/queue/simple/print");  //apwifi2
  $apwifi2= $apwifib[28];
  $apwifi22 = $apwifi2['total-rate'];
  
  $apwific = $API->comm("/queue/simple/print");  //apwifi3
  $apwifi3= $apwific[29];
  $apwifi33 = $apwifi3['total-rate'];
  
  $apwifid = $API->comm("/queue/simple/print");  //apwifi4
  $apwifi4= $apwifid[30];
  $apwifi44 = $apwifi4['total-rate'];
  
  $apwifie = $API->comm("/queue/simple/print");  //apwifi5
  $apwifi5= $apwifie[31];
  $apwifi55 = $apwifi5['total-rate'];
  
  $j1 = number_format($pc1e/$pc1e)*100/100;
  $j3 = number_format($pc3e/$pc3e)*100/100;
  $j5 = number_format($pc5e/$pc5e)*100/100;
  
  $j10 = number_format($pc10e/$pc10e)*100/100;
  $j11 = number_format($pc11e/$pc11e)*100/100;
  $j12 = number_format($pc12e/$pc12e)*100/100;
  $j13 = number_format($pc13e/$pc13e)*100/100;
  $j14 = number_format($pc14e/$pc14e)*100/100;
  $j15 = number_format($pc15e/$pc15e)*100/100;
  $j16 = number_format($pc16e/$pc16e)*100/100;
  $j17 = number_format($pc17e/$pc17e)*100/100;
  $j18 = number_format($pc18e/$pc18e)*100/100;
  $j19 = number_format($pc19e/$pc19e)*100/100;
  $j20 = number_format($pc20e/$pc20e)*100/100;
  $j21 = number_format($pc21e/$pc21e)*100/100;
  $j22 = number_format($pc22e/$pc22e)*100/100;
  $j23 = number_format($pc23e/$pc23e)*100/100;
  $j24 = number_format($pc24e/$pc24e)*100/100;
  $j25 = number_format($pc25e/$pc25e)*100/100;
  $jterisi = number_format($j1+$j3+$j5+$j10+$j11+$j12+$j13+$j14+$j15+$j16+$j17+$j18+$j19+$j20+$j21+$j22+$j23+$j24+$j25);
  $jkosong = number_format(19-$jterisi);
  
  $bawahterisi = number_format(($j1)+($j3)+($j5));
  $bawahkosong = number_format(3-($bawahterisi));
  $atasterisi = number_format (($j10)+($j11)+($j12)+($j13)+($j14)+($j15)+($j16)+($j17)+($j18)+($j19)+($j20)+($j21)+($j22)+($j23)+($j24)+($j25));
  $ataskosong = number_format (16-($atasterisi));

		
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
         </tr>
            <td bgcolor=<?php if($pc1e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc1e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>1<b></td>
            <td bgcolor=<?php if($pc1e < "1"){ echo $bgcolor = "white"; }elseif($pc1b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc1b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc1c" ?> </td>
			<td bgcolor=<?php if($pc1e < "1"){ echo $bgcolor = "white"; }elseif($pc1e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc1e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc1f" ?></td>
        </tr>
			<td bgcolor=<?php if($pc3e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc3e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>3<b></td>
            <td bgcolor=<?php if($pc3e < "1"){ echo $bgcolor = "white"; }elseif($pc3b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc3b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc3c" ?> </td>
			<td bgcolor=<?php if($pc3e < "1"){ echo $bgcolor = "white"; }elseif($pc3e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc3e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc3f" ?></td>
		 </tr>
			<td bgcolor=<?php if($pc5e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc5e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>5<b></td>
            <td bgcolor=<?php if($pc5e < "1"){ echo $bgcolor = "white"; }elseif($pc5b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc5b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc5c" ?> </td>
			<td bgcolor=<?php if($pc5e < "1"){ echo $bgcolor = "white"; }elseif($pc5e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc5e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "$pc5f" ?></td>		
         <tr>
            <td bgcolor=<?php if($pc10e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc10e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>10<b></td>
            <td bgcolor=<?php if($pc10e < "1"){ echo $bgcolor = "white"; }elseif($pc10b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc10b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc10c."  
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc10e < "1"){ echo $bgcolor = "white"; }elseif($pc10e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc10e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc10f."
                      " . $x['hapus']; 
                    ?></td>
        </tr>
			<td bgcolor=<?php if($pc11e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc11e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>11<b></td>
            <td bgcolor=<?php if($pc11e < "1"){ echo $bgcolor = "white"; }elseif($pc11b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc11b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc11c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc11e < "1"){ echo $bgcolor = "white"; }elseif($pc11e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc11e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc11f."
                      " . $x['hapus']; 
                    ?></td>
		 </tr>
			<td bgcolor=<?php if($pc12e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc12e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>12</td>
            <td bgcolor=<?php if($pc12e < "1"){ echo $bgcolor = "white"; }elseif($pc12b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc12b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc12c."  
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc12e < "1"){ echo $bgcolor = "white"; }elseif($pc12e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc12e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc12f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc13e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc13e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>13</td>
            <td bgcolor=<?php if($pc13e < "1"){ echo $bgcolor = "white"; }elseif($pc13b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc13b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc13c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc13e < "1"){ echo $bgcolor = "white"; }elseif($pc13e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc13e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc13f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc14e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc14e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>14</td>
            <td bgcolor=<?php if($pc14e < "1"){ echo $bgcolor = "white"; }elseif($pc14b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc14b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc14c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc14e < "1"){ echo $bgcolor = "white"; }elseif($pc14e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc14e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc14f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc15e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc15e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>15</td>
            <td bgcolor=<?php if($pc15e < "1"){ echo $bgcolor = "white"; }elseif($pc15b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc15b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc15c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc15e < "1"){ echo $bgcolor = "white"; }elseif($pc15e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc15e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc15f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc16e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc16e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>16</td>
            <td bgcolor=<?php if($pc16e < "1"){ echo $bgcolor = "white"; }elseif($pc16b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc16b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc16c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc16e < "1"){ echo $bgcolor = "white"; }elseif($pc16e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc16e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc16f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc17e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc17e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>17</td>
            <td bgcolor=<?php if($pc17e < "1"){ echo $bgcolor = "white"; }elseif($pc17b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc17b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc17c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc17e < "1"){ echo $bgcolor = "white"; }elseif($pc17e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc17e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc17f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc18e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc18e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>18</td>
            <td bgcolor=<?php if($pc18e < "1"){ echo $bgcolor = "white"; }elseif($pc18b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc18b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc18c."  
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc18e < "1"){ echo $bgcolor = "white"; }elseif($pc18e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc18e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc18f."
                      " . $x['hapus']; 
                    ?></td>			
        <tr>
            <td bgcolor=<?php if($pc19e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc19e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>19</td>
           <td bgcolor=<?php if($pc19e < "1"){ echo $bgcolor = "white"; }elseif($pc19b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc19b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc19c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc19e < "1"){ echo $bgcolor = "white"; }elseif($pc19e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc19e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc19f."
                      " . $x['hapus']; 
                    ?></td>
        </tr>
			<td bgcolor=<?php if($pc20e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc20e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>20</td>
            <td bgcolor=<?php if($pc20e < "1"){ echo $bgcolor = "white"; }elseif($pc20b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc20b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc20c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc20e < "1"){ echo $bgcolor = "white"; }elseif($pc20e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc20e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc20f."
                      " . $x['hapus']; 
                    ?></td>
		 </tr>
			<td bgcolor=<?php if($pc21e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc21e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>21</td>
            <td bgcolor=<?php if($pc21e < "1"){ echo $bgcolor = "white"; }elseif($pc21b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc21b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc21c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc21e < "1"){ echo $bgcolor = "white"; }elseif($pc21e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc21e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc21f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc22e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc22e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>22</td>
            <td bgcolor=<?php if($pc22e < "1"){ echo $bgcolor = "white"; }elseif($pc22b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc22b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc22c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc22e < "1"){ echo $bgcolor = "white"; }elseif($pc22e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc22e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc22f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc23e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc23e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>23</td>
            <td bgcolor=<?php if($pc23e < "1"){ echo $bgcolor = "white"; }elseif($pc23b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc23b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc23c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc23e < "1"){ echo $bgcolor = "white"; }elseif($pc23e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc23e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc23f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc24e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc24e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>24</td>
            <td bgcolor=<?php if($pc24e < "1"){ echo $bgcolor = "white"; }elseif($pc24b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc24b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc24c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc24e < "1"){ echo $bgcolor = "white"; }elseif($pc24e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc24e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc24f."
                      " . $x['hapus']; 
                    ?></td>
		</tr>
			<td bgcolor=<?php if($pc25e > "0"){ echo $bgcolor = "Aquamarine"; }elseif($pc25e < "1"){ echo $bgcolor = "white"; }?> style='text-align:center;color:black;'><b>25</td>
            <td bgcolor=<?php if($pc25e < "1"){ echo $bgcolor = "white"; }elseif($pc25b < "1073741825"){ echo $bgcolor = "#04ff00"; }elseif($pc25b > "1073741824"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc25c." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor=<?php if($pc25e < "1"){ echo $bgcolor = "white"; }elseif($pc25e < "1048577"){ echo $bgcolor = "#04ff00"; }elseif($pc25e > "1048576"){ echo $bgcolor = "yellow"; }?> style='text-align:center;color:black;'><?php 
                    echo "".$pc25f."
                      " . $x['hapus']; 
                    ?></td>			
		</tr>
			<td bgcolor=<?php if($servere > "0"){ echo $bgcolor = "tan"; }elseif($servere < "1"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><b>billing<b></td>
            <td bgcolor=<?php if($servere < "1"){ echo $bgcolor = "tan"; }elseif($serverb > "1073741824"){ echo $bgcolor = "tan"; }elseif($serverb < "1073741825"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$serverc" ?> </td>
			<td bgcolor=<?php if($servere > "1048576"){ echo $bgcolor = "tan"; }elseif($servere < "1"){ echo $bgcolor = "tan"; }elseif($servere < "1048577"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$serverf" ?></td>	
		</tr>
			<td bgcolor=<?php if($mamae > "0"){ echo $bgcolor = "tan"; }elseif($mamae < "1"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><b>asus<b></td>
            <td bgcolor=<?php if($mamae < "1"){ echo $bgcolor = "tan"; }elseif($mamab < "1073741825"){ echo $bgcolor = "tan"; }elseif($mamab > "1073741824"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$mamac" ?> </td>
			<td bgcolor=<?php if($mamae < "1"){ echo $bgcolor = "tan"; }elseif($mamae < "1048577"){ echo $bgcolor = "tan"; }elseif($mamae > "1048576"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$mamaf" ?></td>
		</tr>
			<td bgcolor=<?php if($kakae > "0"){ echo $bgcolor = "tan"; }elseif($kakae < "1"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><b>xiaomi<b></td>
            <td bgcolor=<?php if($kakae < "1"){ echo $bgcolor = "tan"; }elseif($kakab < "1073741825"){ echo $bgcolor = "tan"; }elseif($kakab > "1073741824"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$kakac" ?> </td>
			<td bgcolor=<?php if($kakae < "1"){ echo $bgcolor = "tan"; }elseif($kakae < "1048577"){ echo $bgcolor = "tan"; }elseif($kakae > "1048576"){ echo $bgcolor = "tan"; }?> style='text-align:center;color:black;'><?php 
                    echo "$kakaf" ?></td>			
		</tr>
            <td bgcolor="plum"style='text-align:center;'><b>BIND<b></td>
			<td bgcolor="plum"style='text-align:center;'><b><?php 
                    echo "$semua" ?><b></td>
			<td bgcolor="plum" style='text-align:center;color:black;'><b><?php 
                    echo "$binrates" ?></td>
		</tr><tr>
			<td bgcolor="pink" style='text-align:center;color:black;'><b>bawah</td>
			<td bgcolor="pink" style='text-align:center;color:black;'><i class="fa fa-warning"></i> off <?php 
                    echo "$bawahkosong"?> pc</td> 	
			<td bgcolor="pink" style='text-align:center;color:black;'><i class="fa fa-television"></i> on <?php 
                    echo "$bawahterisi" ?> pc</td> 		
		</tr>
		    <td bgcolor="pink" style='text-align:center;color:black;'><b>atas</td>
			<td bgcolor="pink" style='text-align:center;color:black;'><i class="fa fa-warning"></i> off <?php 
                    echo "$ataskosong"?> pc</td> 
			<td bgcolor="pink" style='text-align:center;color:black;'><i class="fa fa-television"></i> on <?php 
                    echo "$atasterisi"?> pc</td> 				
		</tr>
			<td bgcolor="pink" style='text-align:center;color:blue;'><b><b>total<b></td>
			<td bgcolor="pink" colspan="2" style='text-align:center;color:blue;'><b>off <?php 
                    echo "".$jkosong." pc / on ".$jterisi." pc 
                      " . $x['hapus']; 
                    ?></td>				
				
				

	</table>			
</body>
</html> 
</table>
	<table height=200px width=100% border=1 cellpadding=0 cellspacing=5 align="left">	
		
		</tr>
            <td bgcolor="orange" style='text-align:center;color:black;'><b>Indihome</td>
		</tr>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><b><?php 
                    echo "".$ip."
                      " . $x['hapus']; 
                    ?></td>
		
		</tr>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><?php 
                    echo " ".$mayuk." - ".$muyak."
                      " . $x['hapus']; 
                    ?></td>			
					
		</tr>
            <td bgcolor="Cyan" style='text-align:center;color:black;'><?php 
                    echo " ".$downloadall." - ".$uploadall."
                      " . $x['hapus']; 
                    ?></td>
				
		</tr>
            <td bgcolor="plum" style='text-align:center;color:black;'><b><?php 
                    echo "".$realtotal." MiB / ".$realtotalx."
                      " . $x['hapus']; 
                    ?></td>
			
        </tr><tr><tr><tr>
            <td bgcolor="pink" style='text-align:center;color:black;'><?php
                    echo $_cpu_load." : " . $resource['cpu-load'] . "%<br/>
                    ".$_free_memory." : " . formatBytes($resource['free-memory'], 2) . "<br/>
                    ".$_free_hdd." : " . formatBytes($resource['free-hdd-space'], 2)
                    ?></td>
		</tr>
            <td bgcolor="pink" style='text-align:center;color:black;'><?php 
                    echo ucfirst($clock['date']) . " " . $clock['time'] . "<br>
                    ".$_uptime." : " . formatDTM($resource['uptime']);
                    $_SESSION[$session.'sdate'] = $clock['date'];
                    ?></td></tr><tr><tr>	
    </table>
	
	</table>
	     <table height=25px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
        </tr>
           <td bgcolor=<?php if($cctv2 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($cctv2 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>CC TV<b></td>
           <td bgcolor=<?php if($apmama2 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apmama2 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP MM<b></td>
		   <td bgcolor=<?php if($apwifi11 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apwifi11 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP W1<b></td>
		   <td bgcolor=<?php if($apwifi22 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apwifi22 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP W2<b></td>
		   <td bgcolor=<?php if($apwifi33 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apwifi33 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP W3<b></td>	
	       <td bgcolor=<?php if($apwifi44 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apwifi44 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP W4<b></td>
		   <td bgcolor=<?php if($apwifi55 > "0"){ echo $bgcolor = "Aquamarine"; }elseif($apwifi55 < "1"){ echo $bgcolor = "red"; }?> style='text-align:center;color:black;'><b>AP W5<b></td>		
		 </table>
	
	  
</body>
</html> 

<div class="row">
<div id="reloadHotspotActive">
<div class="col-12">
	
        </div>

</table>
	<table height=20px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
           <td bgcolor="plum" style='text-align:center;color:black;'> <?php 
                    echo "".$wifid."
                      " . $x['hapus']; 
                    ?> | <?php 
                    echo "".$wifif."
                      " . $x['hapus'];  
                    ?> </br>pemakai hotspot : <?php
				if ($serveractive == "") {
				} else {
					echo $serveractive . " ";
				}
				if ($counthotspotactive < 2) {
					echo "$counthotspotactive orang";
				} elseif ($counthotspotactive > 1) {
					echo "$counthotspotactive orang";
				};
				if ($serveractive == "") {
				} else {
					echo " | <a href='./?hotspot=active&session=" . $session . "'> <i class='fa fa-search'></i> Show all</a>";
				}
				?></td>
	</table>
   

</div>
</div>
  
<table color=red height=20px width=100% border=1 cellpadding=0 cellspacing=0 align="left">
  <thead>
  <tr>
    <th bgcolor="orange" class="text-center">Nama</th>
    <th bgcolor="orange" class="text-center">Pemakaian</th>
    <th bgcolor="orange" class="text-center">Uptime | Comment</th>
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
	$bytesooo = formatBytes (($rrr), 2);
    $byte = round((($rrr)/1048576), 2);
	$address = $hotspotactive['address'];	
	$loginby = $hotspotactive['login-by'];
	$comment = $hotspotactive['comment'];
	$uriprocess = "'./?remove-user-active=" . $id . "&session=" . $session . "'";?>
	<?php
	echo "<tr>";?>
	<td bgcolor=<?php if($rrr < "1"){ echo $bgcolor = "black"; }elseif($rrr < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($rrr > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($rrr < "1"){ echo $style = "display:none"; }elseif($rrr > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$user." 
                      " . $x['hapus']; 
                    ?></td>
	<td bgcolor=<?php if($rrr < "1"){ echo $bgcolor = "black"; }elseif($rrr < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($rrr > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($rrr < "1"){ echo $style = "display:none"; }elseif($rrr > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$bytesooo." 
                      " . $x['hapus']; 
                    ?></td>
	<td bgcolor=<?php if($rrr < "1"){ echo $bgcolor = "black"; }elseif($rrr < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($rrr > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($rrr < "1"){ echo $style = "display:none"; }elseif($rrr > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$uptime." | ".$comment."
                      " . $x['hapus']; 
                    ?></td>
<?php
}
?>
  </tbody>
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
		$gethotspotactive = $API->comm("/ip/hotspot/user/print", array("?server" => "" . $serveractive . ""));
		$TotalReg = count($gethotspotactive);

		$counthotspotactive = $API->comm("/ip/hotspot/user/print", array(
			"count-only" => "", "?server" => "" . $serveractive . ""
		));

	} else {
		$gethotspotactive = $API->comm("/ip/hotspot/user/print");
		$TotalReg = count($gethotspotactive);

		$counthotspotactive = $API->comm("/ip/hotspot/user/print", array(
			"count-only" => "",
		));
	}
}
?>
<table height=20px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
<h3> <td bgcolor="plum" style='text-align:center;color:black;'> hotspot terdaftar : <?php
				if ($serveractive == "") {
				} else {
					echo $serveractive . " ";
				}
				if ($counthotspotactive < 2) {
					echo "$counthotspotactive orang";
				} elseif ($counthotspotactive > 1) {
					echo "$counthotspotactive orang";
				};
				if ($serveractive == "") {
				} else {
					echo " | <a href='./?hotspot=active&session=" . $session . "'> <i class='fa fa-search'></i> Show all</a>";
				}
				?></td><h3>
				</table>
        
		
        

<table height=20px width=100% border=1 cellpadding=0 cellspacing=0 align="left">
  <thead>
  <tr>
    </th>
    <th bgcolor="orange" class="text-center">Nama</th>
    <th bgcolor="orange" class="text-center">Pemakaian</th>
    <th bgcolor="orange" class="text-center">Uptime | Comment</th>
  </tr>
  </thead>
  <tbody>

  <?php
for ($i = 0; $i < $TotalReg; $i++) {
	$hotspotactive = $gethotspotactive[$i];
	$id = $hotspotactive['.id'];
	$name = $hotspotactive['name'];
	$mac = $hotspotactive['mac-address'];
	$uptime = formatDTM($hotspotactive['uptime']);
	$bytesi = $hotspotactive['bytes-in'];
	$byteso = $hotspotactive['bytes-out'];
	$bytesijadi = formatbytes(($hotspotactive['bytes-in']), 2);
	$bytesojadi = formatbytes(($hotspotactive['bytes-out']), 2);
	$pemakaian = formatBytes(($byteso)+($bytesi), 2);
	$pemakaianasli = (($byteso)+($bytesi));
	$comment = $hotspotactive['comment'];
	$profile = $hotspotactive['profile'];
	$uriprocess = "'./?remove-hotspot-user=" . $id . "&session=" . $session . "'";
	?>
	 <?php
	echo "<tr>";?>
	<td bgcolor=<?php if($pemakaianasli < "1"){ echo $bgcolor = "black"; }elseif($pemakaianasli < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($pemakaianasli > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($pemakaianasli < "1"){ echo $style = "display:none"; }elseif($pemakaianasli > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$name." 
                      " . $x['hapus']; 
                    ?></td>
	<td bgcolor=<?php if($pemakaianasli < "1"){ echo $bgcolor = "black"; }elseif($pemakaianasli < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($pemakaianasli > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($pemakaianasli < "1"){ echo $style = "display:none"; }elseif($pemakaianasli > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$pemakaian." 
                      " . $x['hapus']; 
                    ?></td>
	<td bgcolor=<?php if($pemakaianasli < "1"){ echo $bgcolor = "black"; }elseif($pemakaianasli < "1073741825"){ echo $bgcolor = "Gainsboro"; }elseif($pemakaianasli > "1073741824"){ echo $bgcolor = "yellow"; }?> style=<?php if($pemakaianasli < "1"){ echo $style = "display:none"; }elseif($pemakaianasli > "0"){ echo $style = "text-align:center"; }?>><?php 
                    echo "".$uptime." | ".$comment."
                      " . $x['hapus']; 
                    ?></td>
	<?php echo "</tr>";
}
?>
</table>

<table height=100px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
        <tr>
            <td bgcolor="orange"style='text-align:center;'><b>Total-Bytes-Mikrotik<b></td> 
            <td bgcolor="orange" style='text-align:center;'><b>Total-Bytes-Indihome<b></td>
			<td bgcolor="orange" style='text-align:center;'><b>Total-Bytes-Selisih<b></td>
        </tr>
        <tr>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$tbm."  
                      " . $x['hapus']; 
                    ?></td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$tbi." 
                      " . $x['hapus']; 
                    ?></td>
			<td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$tbs."
                      " . $x['hapus']; 
                    ?></td>
		 </table>

			 <table height=100px width=100% border=1 cellpadding=0 cellspacing=5 align="left">
        <tr>
            <td bgcolor="orange"style='text-align:center;'><b>Total-Speed-Mikrotik<b></td> 
            <td bgcolor="orange" style='text-align:center;'><b>Total-Speed-Indihome<b></td>
        </tr>
        <tr>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$tsm."  
                      " . $x['hapus']; 
                    ?></td>
            <td bgcolor="yellow" style='text-align:center;color:black;'><?php 
                    echo "".$tsi." 
                      " . $x['hapus']; 
                    ?></td></tr><tr>	
		 </table>

</div>
</div>
</div>
</div>
