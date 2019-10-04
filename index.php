<!DOCTYPE html>
<html>
    <head>
        <title>PHP Page</title>
    </head>
    <body>
        <h1>My first PHP page</h1>
		
		<?php
		
			echo "show all rows from postgres database";
			
			$db = parse_url(getenv("DATABASE_URL"));

			$pdo = new PDO("pgsql:" . sprintf(
			"host=%s;port=%s;user=%s;password=%s;dbname=%s",
			$db["host"],
			$db["port"],
			$db["user"],
			$db["pass"],
			ltrim($db["path"], "/")
	));
	
	$sql = "select studentname, course from RegisterCourse"
	$stmt = $pdo ->prepare($sql);
	
	$stmt->setFetchMode(PDO::ASSOC);
	$stmt->execute();
	$resultSet = $stmt->fetchAll();
	?>
	<ul>
		<?php
		foreach($resultSet as $row){
		echo "<li>".
			$row["studentname"] . '--'. $row["course"]
			."<li>";
			}
			?>
    </body>
</html>