<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>indexHTML</title>
    <!--Verbindung zu chartjs.com für das Balkendiagramm-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--Verbindung zur externen CSS Datei-->
    <link rel="stylesheet" href="Css/style.css">
</head>

<body>
    <!--Formular für die Suchfunktion-->
    <form action="index.php" method="GET">
    <input type="hidden" name="path" value="<?php echo $_GET['path']; ?>">
    
    <!--input feld für die Eingabe der zu suchenden Datei-->
    <!-- get request mit suchfeld -->
    <input type="text" name="suchfeld" placeholder="Nach einer Datei suchen" 
    value="<?php if (isset($_GET['suchfeld'])) {echo $_GET['suchfeld'];} ?>"/><br />

    <!--Submit Absenden--> 
    <input type="Submit" value="Suchen"/>
    </form>
  
    <!-- Leeres div als Platz deklariert-->
    <div id="searchResult"></div>

    <!-- Canvas Tag eignet sich für die Darstellung von Grafiken und Zeichnungen -->
    <canvas id="barChartFiles"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
    
    <table border=3>
      <tr>
        <!--Text für die Tabelle-->
        <th class=tableheader1>Ordner / Datei Name</th>
        <th class=tableheader2>Grösse in KB</th>
      </tr>
    </table>