<?php
include 'WerkBeheer.php';

//edit listener\\
if (isset($_POST['edit'])) {
	$WerkBeheer = new WerkBeheer;
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
	if(isset($_POST["id"])) {
		$id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
		// echo $id;
		// 	echo $km ."<br>";
		// 	echo $locatie."<br>";
		// 	echo $Aankomst."<br>";
		// 	echo $Vertrek."<br>";
		// 	echo $No."<br>";
		aanpas($id, $km, $locatie, $Aankomst, $Vertrek, $No);
	} else {
		echo "Geen id gekregen !<br>";
		echo$_POST['id'];
	}
	// unset($_SESSION['firstsearch']);
}


//add listener\\
if (isset($_POST["toevogen"])) {
	$WerkBeheer = new WerkBeheer;
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
	// unset($_SESSION['firstsearch']);
	add($km, $locatie, $Aankomst, $Vertrek, $No);
}


//funccties\\
function laden($input = "") {
	$WerkBeheer = new WerkBeheer;
	if($input) {
		$WerkBeheer->setDag($_SESSION["dag"]);
		$WerkBeheer->setWeek($_SESSION["weeknr"]);
		$WerkBeheer->setJaar($_SESSION["jaar"]);
		echo $WerkBeheer->load();
	}
	if (isset($_POST["verstuurdatum"])){
		if(isset($_POST["dag"])) {
			
			$_SESSION["dag"] = $_POST["dag"];
			$WerkBeheer->setDag($_POST["dag"]);
		}
		if(isset($_POST["weeknr"])) {
			$_SESSION["weeknr"] = $_POST["weeknr"];
			$WerkBeheer->setWeek($_POST["weeknr"]);
		}
		if(isset($_POST["jaar"])) {
			$_SESSION["jaar"] = $_POST["jaar"];
			$WerkBeheer->setJaar($_POST["jaar"]);
		}
		if ($_SESSION["firstsearch"])
		{
			// $_SESSION['firstsearch'] = true;
		}
			$WerkBeheer->setDag($_SESSION["dag"]);
			$WerkBeheer->setWeek($_SESSION["weeknr"]);
			$WerkBeheer->setJaar($_SESSION["jaar"]);
			echo $WerkBeheer->load();
	}
		// if ($_SESSION["firstsearch"] === false)
		// {
	
		// 	echo $WerkBeheer->load();
		// }
}
function add($km, $locatie, $Aankomst, $Vertrek, $No) {
	$WerkBeheer = new WerkBeheer;
	$result = $WerkBeheer->add($km, $locatie, $Aankomst, $Vertrek, $No);
	// echo $km . "<br>" . $locatie . "<br>" . $Aankomst . "<br>" . $Vertrek . "<br>" . $No;
	if ($result) {
		laden($result);
		// echo "gelukt";
		// $WerkBeheer->setDag($_SESSION["dag"]);
		// 	$WerkBeheer->setWeek($_SESSION["weeknr"]);
		// 	$WerkBeheer->setJaar($_SESSION["jaar"]);
		// $WerkBeheer->load();
	} else {
		echo "mislukt";
	}
}
function aanpas($id, $km, $locatie, $Aankomst, $Vertrek, $No){
	$WerkBeheer = new WerkBeheer;
	$result = $WerkBeheer->edit($id, $km, $locatie, $Aankomst, $Vertrek, $No);
	if($result){
		laden($result);
		// echo "gelukt";
		
		// $WerkBeheer->load();
		
	} else {
		echo "mislukt";
	}
}
?>