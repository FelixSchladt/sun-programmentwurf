<!DOCTYPE html>
<html>
<head>
    <title>Stellenanzeigen</title>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: black;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #004d00; /* Dark Green */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            padding: 20px;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .job {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .nav {
            background-color: #009900; /* Light Green */
            padding: 10px 0;
            text-align: center;
        }
        .nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }
        .nav a:hover {
            background-color: #006600;
        }
 
    </style>
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
    // Setzen Sie $searchTerm auf den gesendeten Wert oder auf einen leeren String
    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

    // Datenbankverbindung
    $dbPath = 'jobs.db';
    $db = new SQLite3($dbPath);

    // Datenbankabfrage, die immer ausgeführt wird
    $query = "SELECT * FROM Jobs WHERE JobTitle LIKE '%$searchTerm%'";

    $results = $db->query($query);

    // Ergebnisse anzeigen
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

    // Schließen der Datenbankverbindung
    $db->close();
    ?>
</div>
<div class="footer">
    <p>&copy; 2023 Wissensmanufaktur GmbH</p>
</div>
</body>
</html>
