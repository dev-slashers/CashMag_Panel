<?php
//Admin Setting

$admin_user 	= "root";
$admin_pass 	= "";
$admin_mail 	= "salvatore.turboli@gmail.com";
$site_title 	= "CashMag - Gestionale Bar";
$site_path 		= "http://192.168.0.3/cashmag/";
$download_p 	= "download/cashmag.exe";
$download_guida = "http://cashmag.altervista.org/download/guida.pdf";
$telegram_link  = "https://t.me/turboli_salvatore";
//Database Setting
	
$db_host 		= "localhost";
$db_username 	= "root";
$db_password 	= "";
$db_name 		= "cashmag";

$create_database = false;
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if($create_database == true)
{
	$mysqli->autocommit(true);
	$mysqli->query("CREATE TABLE User 
			(id INT UNSIGNED AUTO_INCREMENT NOT NULL,
			Founder TEXT NOT NULL,
			Email TEXT NOT NULL,
			Licenza TEXT NOT NULL,
			Abilitato TEXT NOT NULL,
			Download_Key TEXT NOT NULL, 
			Ultimo_Accesso TEXT NOT NULL, 
			Workstation TEXT NOT NULL, 
			PRIMARY KEY(id));");

	$mysqli->query("CREATE TABLE Account 
			(id INT UNSIGNED AUTO_INCREMENT NOT NULL,
			Email TEXT NOT NULL,
			Username TEXT NOT NULL,
			Password TEXT NOT NULL,
			Crediti TEXT NOT NULL,
			Data_Reg TEXT NOT NULL,
			PRIMARY KEY(id));");

	$mysqli->query("CREATE TABLE Setting
		(id INT UNSIGNED AUTO_INCREMENT NOT NULL,
		Reset_Enabled boolean not null default 1,
		Delete_Enabled boolean not null default 1,
		Create_Enabled boolean not null default 1,
		PRIMARY KEY(id));");

	$mysqli->query("insert into Setting (Reset_Enabled,Delete_Enabled,Create_Enabled) VALUES (1,1,1);");
}
?>

