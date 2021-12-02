<?php

function generate_pdf($object, $filename='', $direct_download=TRUE)
{
	require_once("dompdf/dompdf_config.inc.php");
	//
	$dompdf = new DOMPDF();
	$dompdf->load_html($object);
	$dompdf->render();
	//
	if ($direct_download == TRUE)
	$dompdf->stream($filename, array('Attachment'=>0));
	else
	return $dompdf->output();
}

?>