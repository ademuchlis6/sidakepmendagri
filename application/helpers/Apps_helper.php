<?php

function lokasi($id='') {
	$kec = array(
		'KANTOR DINAS',
		'CIANJUR',
		'WARUNGKONDANG',
		'CIBEBER',
		'CILAKU',
		'CIRANJANG',
		'BOJONGPICUNG',
		'KARANGTENGAH',
		'MANDE',
		'SUKALUYU',
		'PACET',
		'CUGENANG',
		'CIKALONGKULON',
		'SUKARESMI',
		'SUKANAGARA',
		'CAMPAKA',
		'TAKOKAK',
		'KADUPANDAK',
		'PAGELARAN',
		'TANGGEUNG',
		'CIBINONG',
		'SINDANGBARANG',
		'AGRABINTA',
		'CIDAUN',
		'NARINGGUL',
		'CAMPAKA MULYA',
		'CIKADU',
		'GEKBRONG',
		'CIPANAS',
		'CIJATI',
		'LELES',
		'HAURWANGI',
		'PASIRKUDA'
		);
    return ($id <> '' ? $kec[$id] : $id);
}

function bulan($b)
{
	$bulan = array(
		1 =>'Januari',
		2 =>'Februari',
		3 =>'Maret',
		4 =>'April',
		5 =>'Mei',
		6 =>'Juni',
		7 =>'Juli',
		8 =>'Agustus',
		9 =>'September',
		10 =>'Oktober',
		11 =>'November',
		12 =>'Desember');
	return $bulan[$b];
}

function getmonth($id='')
{
	$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember');

	return ($id <> '' ? $bulan[$id] : $bulan);
}

function getdnow()
{
	$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember');

	$m = date('m');
	$d = date('d');
	$y = date('Y');

	$bln = $bulan[$m];

	$r = $d." ".$bln." ".$y;
	return $r;
} 


function get_alert($title, $pesan, $status)
{
	$html = '<div class="alert alert-'.$status.'">';
	$html .= '<h4>'.strtoupper($title).'</h4>';
	$html .= '<p>'.$pesan.'</p>';
	$html .= '</div>';

	return $html;
}


?>