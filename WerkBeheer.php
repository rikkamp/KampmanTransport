<?
session_start();
setlocale(LC_ALL, 'nl_NL');
class WerkBeheer {
	private $dag;
	private $week;
	private $jaar;

	public function setDag($dag) {
		$newdag = filter_var($dag, FILTER_SANITIZE_STRING);
		$this->dag = $newdag;
	}
	public function getDag() {
		if(isset($_SESSION["dag"])) {
			return $_SESSION["dag"];
		} else {
		return $this->dag;
		}
	}
	public function setWeek($week) {
		$newweek = filter_var($week, FILTER_SANITIZE_NUMBER_INT);
		$this->week = $newweek;
	}
	public function getWeek() {
		if(isset($_SESSION["week"])) {
			return $_SESSION["week"];
		} else {
		return $this->week;
		}
	}
	public function setJaar($jaar) {
		$newjaar = filter_var($jaar, FILTER_SANITIZE_NUMBER_INT);
		$this->jaar = $newjaar;
	}
	public function getJaar() {
		if(isset($_SESSION["jaar"])) {
			return $_SESSION["jaar"];
		} else {
		return $this->jaar;
		}
	}
	public function load() {
		include 'conn.php';
		if(!isset($this->dag) && !isset($this->week) && !isset($this->jaar)) {
			if(!isset($_SESSION["jaar"]) && !isset($_SESSION["dag"]) && !isset($_SESSION["week"])) {
				$answer = "<div class='error'> nog geen datum uitgevoerd <div>";
				echo $answer;
			}
		} else {
			if(!isset($dag) && !isset($week) && !isset($jaar)) {
				$dag = $_SESSION["dag"];
				$jaar = $_SESSION["jaar"];
				$week = $_SESSION["week"];
				// echo "sessie";
			} else {
				$dag = $this->getDag();
				$jaar = $this->getJaar();
				$week = $this->getWeek();
				$_SESSION["dag"] = $this->getDag();
				$_SESSION["jaar"] = $this->getJaar();
				$_SESSION["week"] = $this->getWeek();
			}
			$sql = "SELECT * FROM gegevens WHERE Week = :week AND Dag = :dag AND Jaar = :jaar";
			$stmt = $conn->prepare($sql);
			// echo $dag, $jaar, $week . "<br>". $sql;
			$stmt->bindparam(':week', $week, \PDO::PARAM_INT);
			$stmt->bindParam(':dag', $dag, \PDO::PARAM_STR);
			$stmt->bindParam(':jaar', $jaar, \PDO::PARAM_INT);
			if($stmt->execute()) {
				$answer = "";
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$answer .= "
					<tr class='row{$row['ID']}'>
						<td class='id{$row["ID"]}'>{$row["ID"]}</td>
						<td data-km='{$row['Km']}' class='km{$row["ID"]}'>{$row['Km']}</td>
						<td data-loc='{$row['Locatie']}'class='loc{$row["ID"]}'>{$row['Locatie']} </td>
						<td data-aan='{$row['Aankomst']}'class='aan{$row["ID"]}'>{$row['Aankomst']} </td>
						<td data-ver='{$row['Vertrek']}'class='ver{$row["ID"]}'>{$row['Vertrek']} </td>
						<td data-no='{$row['No']}'class='no{$row["ID"]}'>{$row['No']} </td>
						<td><button class='aanpas' onclick=pasaan() value='{$row["ID"]}'>aanpas</button></td>
					</tr>
					";
				}
				
			}
			return $answer;
		}
	}
	public function add($km, $locatie, $Aankomst, $Vertrek, $No) {
		include 'conn.php';
		if(!isset($this->dag) && !isset($this->week) && !isset($this->jaar)) {
			if(!isset($_SESSION["jaar"]) && !isset($_SESSION["dag"]) && !isset($_SESSION["week"])) {
				$answer = "<div class='error'> nog geen datum uitgevoerd <div>";
				echo $answer;
			} else {
				$dag = $_SESSION["dag"];
				$jaar = $_SESSION["jaar"];
				$week = $_SESSION["week"];
				// echo "sessie";
			}
		} else {
			$dag = $this->getDag();
			$jaar = $this->getJaar();
			$week = $this->getWeek();
			$_SESSION["dag"] = $this->getDag();
			$_SESSION["jaar"] = $this->getJaar();
			$_SESSION["week"] = $this->getWeek();
		}
		// echo $km ." km<br>". $locatie . ": loc<br>". $Aankomst ." : aankom<br>". $Vertrek ." : ver<br>". $No . ": no<br>". $jaar .": jaar<br>". $week .": week<br>" . $dag;
		$sql = "INSERT INTO gegevens (ID, Jaar, Week, Dag, km, Locatie, Aankomst, Vertrek, No)
		Values
		(NULL, :Jaar, :Week, :Dag, :Km, :Locatie, :Aankomst, :vertrek, :Num)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':Jaar', $jaar, \PDO::PARAM_INT);
		$stmt->bindParam(':Week', $week, \PDO::PARAM_INT);
		$stmt->bindParam(':Dag', $dag, \PDO::PARAM_STR);
		$stmt->bindParam(':Km', $km, \PDO::PARAM_STR);
		$stmt->bindParam(':Locatie', $locatie, \PDO::PARAM_STR);
		$stmt->bindParam(':Aankomst', $Aankomst, \PDO::PARAM_STR);
		$stmt->bindParam(':vertrek', $Vertrek, \PDO::PARAM_STR);
		$stmt->bindParam(':Num', $No, \PDO::PARAM_STR);
		if($stmt->execute()) {
			$answer = true;
		} else {
			// echo $sql;
			$answer = $conn->errorInfo();
		}
		return $answer;
	}
	public function edit ($id, $Km, $locatie, $Aankomst, $Vertrek, $num) {
		include 'conn.php';
		$dag = $this->dag;
		$jaar = $this->jaar;
		$week = $this->week;
		$sql = "UPDATE gegevens SET Km = :Km, Locatie = :Locatie, Aankomst = :Aankomst, Vertrek = :vertrek, No = :Num WHERE ID = :id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':Km', $Km, PDO::PARAM_STR);
		$stmt->bindParam(':Locatie', $locatie, PDO::PARAM_STR);
		$stmt->bindParam('Aankomst', $Aankomst, PDO::PARAM_STR);
		$stmt->bindParam(':vertrek', $Vertrek, PDO::PARAM_STR);
		$stmt->bindParam(':Num', $num, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		if($stmt->execute()) {
			$answer = true;
		} else {
			$answer = false;
		}
		return $answer;
	}
}

?>