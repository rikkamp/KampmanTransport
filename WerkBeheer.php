<?
setlocale(LC_ALL, 'nl_NL');
class WerkBeheer {
	private $dag;
	private $week;
	private $jaar;

	public function setDag($dag) {
		$newdag =filter_var($dag, FILTER_SANITIZE_STRING);
		$this->dag = $newdag;
	}
	public function getDag() {
		return $this->dag;
	}
	public function setWeek($week) {
		$newweek = filter_var($week, FILTER_SANITIZE_NUMBER_INT);
		$this->week = $newweek;
	}
	public function getWeek() {
		return $this->week;
	}
	public function setJaar($jaar) {
		$newjaar = filter_var($jaar, FILTER_SANITIZE_NUMBER_INT);
		$this->jaar = $newjaar;
	}
	public function getJaar() {
		return $this->jaar;
	}
	public function load() {
		include 'conn.php';
		$dag = $this->dag;
		$jaar = $this->jaar;
		$week = $this->week;
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
				<td data-ver='{$row['vertrek']}'class='ver{$row["ID"]}'>{$row['vertrek']} </td>
				<td data-no='{$row['No']}'class='no{$row["ID"]}'>{$row['No']} </td>
				<td><button class='aanpas' onclick=pasaan() value='{$row["ID"]}'>aanpas</button></td>
			</tr>
			";
		}
		echo $answer;
		}
	}
	public function add($km, $locatie, $Aankomst, $Vertrek, $No) {
		include 'conn.php';
		
		
	}
}

?>