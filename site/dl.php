<?php

//Generic binary file downloading (when file exists)

$filename = r('f/'.$_GET['f']);

if (file_exists($filename)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($filename));
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filename));
	ob_end_flush();
	readfile($filename);
	exit;
}

else header('Location: '.r('404'));
