<?php
include 'WerkBeheer.php';
session_start();
if (!isset($_SESSION["classexist"])) {
	$WerkBeheer = new WerkBeheer;
	$_SESSION["classexist"] = $WerkBeheer;
} else {
	$WerkBeheer = $_SESSION["classexist"];
}

//add listener\\
if (isset($_POST["toevogen"])) {
	if(isset($km))
	{
		$km = "";
	} else {
		$km = filter_var($km, FILTER_SANITIZE_STRING);
	}
	if(!isset($locatie)) {
		$locatie = "";
	} else {
		$locatie = filter_var($locatie, FILTER_SANITIZE_STRING);
	}
	if(!isset($Aankomst)) {
		$Aankomst = "";
	} else {
		$Aankomst = filter_var($Aankomst, FILTER_SANITIZE_STRING);
	}
	if(!isset($Vertrek)) {
		$Vertrek = "";
	} else {
		$Vertrek = filter_var($Vertrek, FILTER_SANITIZE_STRING);
	}
	if(!isset($No)) {
		$No = "";
	} else {
		$No = filter_var($No, FILTER_SANITIZE_STRING);
	}
	$_POST[""];
	// add($km, $locatie, $Aankomst, $Vertrek, $No);
}

//funccties\\
function laden() {
	
	if (!isset($_SESSION["classexist"])) {
		$WerkBeheer = new WerkBeheer;
		$_SESSION["classexist"] = $WerkBeheer;
	} else {
		$WerkBeheer = $_SESSION["classexist"];
	}

	if (isset($_POST["verstuurdatum"])){
		if(isset($_POST["dag"])) {
			$WerkBeheer->setDag($_POST["dag"]);
		}
		if(isset($_POST["weeknr"])) {
			$WerkBeheer->setWeek($_POST["weeknr"]);
		}
		if(isset($_POST["jaar"])) {
			$WerkBeheer->setJaar($_POST["jaar"]);
		}
		if (!isset($_SESSION["firstsearch"]))
		{
			$WerkBeheer->load();
			$_SESSION['firstsearch'] = true;
		}
	}
	if ($_SESSION["firstsearch"])
	{
		echo "deze";
		$WerkBeheer->load();
	}
	
	print_r($_SESSION);
	

}
function add($km, $locatie, $Aankomst, $Vertrek, $No) {
	$WerkBeheer->add($km, $locatie, $Aankomst, $Vertrek, $No);
}
?>