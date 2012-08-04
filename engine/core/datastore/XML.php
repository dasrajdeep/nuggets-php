<?php
	$db=$doc->getElementsByTagName('database');
	$db=$db->item(0);
	$db_host=$db->getElementsByTagName('host')->item(0)->nodeValue;
	$db_name=$db->getElementsByTagName('name')->item(0)->nodeValue;
	$db_user=$db->getElementsByTagName('username')->item(0)->nodeValue;
	$db_password=$db->getElementsByTagName('password')->item(0)->nodeValue;
	$site=$doc->getElementsByTagName('site')->item(0);
	$site_name=$site->getElementsByTagName('name')->item(0)->nodeValue;
	$profile=$doc->getElementsByTagName('profile')->item(0);
	
	function readXML($filename) {
		$doc=new DOMDocument();
		$doc->load('');
		$root=$doc->documentElement;
	}
?>