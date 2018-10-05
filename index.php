<?php
include 'functions.php';
?>
<html lang="nl">
<head>
	<meta charset="UTF-8">
	<title>Werk Beheer</title>
</head>
<body>
	<header>

	</header>
	<main>
		<h1>Werk Beheer:</h1>
		<!-- Datum tabel -->
		<div class="test">
			<form method="post" name="WeekDag" action="">
			<table>
				<tr>
					<th>jaar:<input class="jaar" type="number" name="jaar" value=""></th>
					<th>Week:<input class="week" type="number" name="weeknr" value=""></th>
					<th>dag: 
						<select class="dag" name="dag">
							<option value="Maandag">Maandag</option>
							<option value="Dinsdag">Dinsdag</option>
							<option value="Woensdag">Woensdag</option>
							<option value="Donderdag">Donderdag</option>
							<option value="Vrijdag">Vrijdag</option>
							<option value="Zaterdag">Zaterdag</option>
							<option value="Zondag">Zondag</option>
						</select>
					</th>
				</tr>
			</table>
			<input type="submit" name="verstuurdatum" value="haal week op" />
			</form>
		</div>
		<!-- info tabel -->
		<div class="">
			<table>
				<tr>
					<th>#</th>
					<th>Km</th>
					<th>Locatie</th>
					<th>Aankomst</th>
					<th>vertrek</th>
					<th>No</th>
				</tr>
				<!-- hier komt de data -->
				<? laden(); ?>
				<form method="post" name="Nieuw" action="">
					<tr>
						<td></td>
						<td><input type="text" name="Km"></td>
						<td><input type="text" name="Locatie"></td>
						<td><input type="text" name="Aankomst"></td>
						<td><input type="text" name="Vertrek"></td>
						<td><input type="text" name="No"></td>
						<td> <input type="submit" name="toevogen" value="Nieuwe regel toevoegen" /></td>
					</tr>
				</form>
			</table>
		</div>
	</main>
	<footer>
	</footer>
	<script src="js/script.js"></script>
</body>
</html>
