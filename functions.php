<?php
include 'WerkBeheer.php';
session_start();
if (!isset($_SESSION["classexist"])) {
	$WerkBeheer = new WerkBeheer;
	$_SESSION["classexist"] = $WerkBeheer;
} else {
	$WerkBeheer = $_SESSION["classexist"];
}

function laden() {
	
	if (!isset($_SESSION["classexist"])) {
		$WerkBeheer = new WerkBeheer;
		$_SESSION["classexist"] = $WerkBeheer;
	} else {
		$WerkBeheer = $_SESSION["classexist"];
	}
	if ($_SESSION["firstsearch"] == true )
	{
		$WerkBeheer->load();
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
	
	print_r($_SESSION);
	

}
function add() {

}
?>