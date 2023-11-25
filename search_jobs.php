<!DOCTYPE html>
<html>
<head>
    <title>Stellenanzeigen</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    <h1>Stellenanzeigen</h1>
</div>

<div class="nav">
    <a href="index.html">Startseite</a>
    <a href="search_jobs.php">Jobs</a>
    <a href="index.html#imprint">Impressum</a>
</div>


<div class="container">
    <div class="search-form">
        <form method="post" action="search_jobs.php">
            <input type="text" name="search" placeholder="Jobtitel suchen...">
            <input type="submit" value="Suchen">
        </form>
    </div>

    <?php
    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

    $dbPath = '/opt/db/jobs.db';
    $db = new SQLite3($dbPath);

    //Faulty SQL Injection vulnerable query
    $query = "SELECT * FROM Jobs WHERE JobTitle LIKE '%$searchTerm%'"; 

    $results = $db->query($query);

    // Proper prepared Statement against SQL injection attacks
    /*
        $query = $db->prepare("SELECT * FROM Jobs WHERE JobTitle LIKE :search");
        $query->bindValue(':search', $searchTerm, SQLITE3_STRING);
        $results = $query->execute();
     */

    if ($results) {
        while ($row = $results->fetchArray()) {
            echo "<div class='job'>";
            echo "<strong>Stelle:</strong> " . htmlspecialchars($row['JobTitle']) . "<br>";
            echo "<strong>Beschreibung:</strong> " . htmlspecialchars($row['Description']) . "<br>";
            echo "<strong>Stellentyp:</strong> " . htmlspecialchars($row['EmploymentType']) . "<br>";
            echo "</div>";
        }
    } else {
        echo "Keine Jobs gefunden.";
    }

    $db->close();
    ?>
</div>
<div class="footer">
    <p>&copy; 2023 Wissensmanufaktur GmbH</p>
</div>
</body>
</html>
