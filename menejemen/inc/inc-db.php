<?php
error_reporting(0);
$host="localhost";
$username="root";
$password="";
$database="penyewaan";
$connect=mysql_connect($host,$username,$password) or die('error connecting to mysql');
mysql_select_db($database,$connect);
// FUNGSI DATE CONVERT
	function jin_date_sql($date){
		$exp = explode('/',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	function jin_date_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'/'.$exp[1].'/'.$exp[0];
		}
		return $date;
	}
	  function buatkode($tabel,$inisial){
                    $struktur = mysql_query("SELECT * from $tabel");
                    $field = mysql_field_name($struktur,0);
                    $panjang = mysql_field_len($struktur,0);
                    $qry    = mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
                    $row    = mysql_fetch_array($qry); 
                    if ($row[0]=="") {
                        $angka = 0;
                    }else{
                        $angka = substr($row[0],strlen($inisial));
                    }
                    $angka++;
                    $angka = strval($angka);
                    $tmp = "";
                    for ($i=1; $i <= ($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
                        $tmp = $tmp."0";
                    }return $inisial.$tmp.$angka;
            }
            // fungsi rupiah
            function rupiah($nilai, $pecahan = 0) {
                  return number_format($nilai, $pecahan, ',', '.');
              }

?>
