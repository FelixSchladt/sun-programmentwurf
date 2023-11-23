<!DOCTYPE html>
<html>
<head>
    <title>Job-Suche</title>
</head>
<body>

<h1>Suche nach Jobtiteln</h1>

<!-- Suchformular -->
<form method="post" action="search_jobs.php">
    <input type="text" name="search">
    <input type="submit" value="Suchen">
</form>

<?php
// Überprüfen, ob eine Suchanfrage gesendet wurde
if (isset($_POST['search'])) {
    // Datenbankverbindung
    $dbPath = 'pfad/zur/jobs.db';
    $db = new SQLite3($dbPath);

    $searchTerm = $_POST['search'];

    // SQL-Injection-anfällige Abfrage
    $query = "SELECT * FROM Jobs WHERE JobTitle LIKE '%$searchTerm%'";

    $results = $db->query($query);

    // Ergebnisse anzeigen
    if ($results) {
        while ($row = $results->fetchArray()) {
            echo "<div>";
            echo "<strong>Job ID:</strong> " . htmlspecialchars($row['JobID']) . "<br>";
            echo "<strong>Job Title:</strong> " . htmlspecialchars($row['JobTitle']) . "<br>";
            echo "<strong>Description:</strong> " . htmlspecialchars($row['Description']) . "<br>";
            echo "<strong>Employment Type:</strong> " . htmlspecialchars($row['EmploymentType']) . "<br>";
            echo "</div><br>";
        }
    } else {
        echo "Keine Jobs gefunden.";
    }

    // Schließen der Datenbankverbindung
    $db->close();
}
?>

</body>
</html>
