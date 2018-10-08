<?php
include 'WerkBeheer.php';
session_start();
if (!isset($_SESSION["classexist"])) {
	$WerkBeheer = new WerkBeheer;
	$_SESSION["classexist"] = $WerkBeheer;
} else {
	$WerkBeheer = $_SESSION["classexist"];
}


//edit listener\\
if (isset($_POST['edit'])) {
	if(!isset($_POST["km"]))
	{
		$km = "";
	} else {
		$km = filter_var($_POST["km"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["loc"])) {
		$locatie = "";
	} else {
		$locatie = filter_var($_POST["loc"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["aan"])) {
		$Aankomst = "";
	} else {
		$Aankomst = filter_var($_POST["aan"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["ver"])) {
		$Vertrek = "";
	} else {
		$Vertrek = filter_var($_POST["ver"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["no"])) {
		$No = "";
	} else {
		$No = filter_var($_POST["no"], FILTER_SANITIZE_STRING);
	}
	unset($_SESSION['firstsearch']);
}


//add listener\\
if (isset($_POST["toevogen"])) {
	if(!isset($_POST["Km"]))
	{
		$km = "";
	} else {
		$km = filter_var($_POST["Km"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["Locatie"])) {
		$locatie = "";
	} else {
		$locatie = filter_var($_POST["Locatie"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["Aankomst"])) {
		$Aankomst = "";
	} else {
		$Aankomst = filter_var($_POST["Aankomst"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["Vertrek"])) {
		$Vertrek = "";
	} else {
		$Vertrek = filter_var($_POST["Vertrek"], FILTER_SANITIZE_STRING);
	}
	if(!isset($_POST["No"])) {
		$No = "";
	} else {
		$No = filter_var($_POST["No"], FILTER_SANITIZE_STRING);
	}
	unset($_SESSION['firstsearch']);
	add($km, $locatie, $Aankomst, $Vertrek, $No);
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
		if (isset($_SESSION["firstsearch"]))
		{
			$WerkBeheer->load();
			$_SESSION['firstsearch'] = true;
		}
	}
		if (!isset($_SESSION["firstsearch"]))
		{
			$WerkBeheer->load();
		}
}
function add($km, $locatie, $Aankomst, $Vertrek, $No) {
	if (!isset($_SESSION["classexist"])) {
		$WerkBeheer = new WerkBeheer;
		$_SESSION["classexist"] = $WerkBeheer;
	} else {
		$WerkBeheer = $_SESSION["classexist"];
	}
	$result = $WerkBeheer->add($km, $locatie, $Aankomst, $Vertrek, $No);
	if ($result === true) {
		echo "gelukt";
	} else {
		echo "mislukt";
	}
}
?>