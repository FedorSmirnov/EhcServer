<?php

/*

Konfigurationseinstellungen fuer FTP-Skripte

Version 1.0. - 24.07.2013

 */

class FtpConfig {
	
	// -----------------------------------------------------------------------------
	// Konfiguration
	private $version = "";
	private $date = "";
	private $pathToServerRoot = "";
	private $pathToLocalRoot = "";
	private $ftpHost = "";
	private $ftpPort = "";
	private $ftpUser = "";
	private $ftpPass = "";
	private $dbHost = "";
	private $dbName = "";
	private $dbUser = "";
	private $dbPass = "";
	
	public function __construct(){
		
		// Zielortunabhaengig
		$this->version = "1.0.2";
		$this->date = "03.11.2013";
		
		// lokaler Testserver 
// 		$this->pathToServerRoot = "";
//		$this->pathToLocalRoot = "";
// 		$this->ftpHost = "";
// 		$this->ftpPort = "";
// 		$this->ftpUser = "";
// 		$this->ftpPass = "";
// 		$this->dbHost = "";
// 		$this->dbName = "";
// 		$this->dbUser = "";
// 		$this->dbPass = "";
		
		// Produktivumgebung joba
		$this->pathToServerRoot = "/"; 	// "" /projekte/dev/EhcServer
		$this->pathToLocalRoot = "\\Users\\jobauer\\workspace\\EhcServer\\"; // ""
		$this->ftpHost = "paradoxfeet.de";
		$this->ftpPort = "21";
		$this->ftpUser = "f0088187"; 		// f0088187 "w006a096";
		$this->ftpPass = "xfz9sVUvRBJRZxSX"; // xfz9sVUvRBJRZxSX "0VUF53fuMn";
		$this->dbHost = "localhost";
		$this->dbName = "d0171593";
		$this->dbUser = "d0171593";
		$this->dbPass = "ehc";
		
		// Produktivumgebung ehome-center
// 		$this->pathToServerRoot = "";
// 		$this->ftpHost = "";
// 		$this->ftpPort = "";
// 		$this->ftpUser = "";
// 		$this->ftpPass = "";
// 		$this->dbHost = "";
// 		$this->dbName = "";
// 		$this->dbUser = "";
// 		$this->dbPass = "";
	}
	
	// Accessors 
	public function getVersion(){
		return $this->version;
	}
	
	public function getDate(){
		return $this->date;
	}
	
	public function getPathToServerRoot(){
		return $this->pathToServerRoot;
	}
	
	public function getPathToLocalRoot(){
		return $this->pathToLocalRoot;
	}
	
	public function getFtpHost(){
		return $this->ftpHost;
	}
	
	public function getFtpPort(){
		return $this->ftpPort;
	}
	
	public function getFtpUser(){
		return $this->ftpUser;
	}
	
	public function getFtpPass(){
		return $this->ftpPass;
	}
	
	public function getDbHost(){
		return $this->dbHost;
	}
	
	public function getDbName(){
		return $this->dbName;
	}
	
	public function getDbUser(){
		return $this->dbUser;
	}
	
	public function getDbPass(){
		return $this->dbPass;
	}
	
}

?>