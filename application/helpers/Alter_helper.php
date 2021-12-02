<?php

$ci =& get_instance();
$ci->load->database();
$sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'";
$q = $ci->db->query($sql);

?>