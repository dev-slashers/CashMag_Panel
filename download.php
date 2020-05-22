<?php
	include 'lib/database.php';

	$db = new Database();

	$download_id = isset($_GET["id"]) ? $_GET["id"] : null;

	if($db->Check_ID($download_id) == true) 
	{
		 header('Content-Description: File Transfer');
		 header('Content-Type: application/octet-stream');
		 header('Content-Disposition: attachment; filename='.basename($download_p));
		 header('Content-Transfer-Encoding: binary');
		 header('Expires: 0');
		 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		 header('Pragma: public');
		 header('Content-Length: ' . filesize($download_p));
		 ob_clean();
		 flush();
		 readfile($download_p);
		 exit;
	}else
	{
		header("Location: index.php");
	}
	

?>