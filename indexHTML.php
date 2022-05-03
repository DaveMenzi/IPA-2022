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
<form action="indexHTML.php" method="POST">
<!--input feld für die Eingabe der zu suchenden Datei-->    
<input type="text" name="suchfeld" placeholder="Nach einer Datei suchen" /><br />
<!--Submit Absenden--> 
<input type="Submit" value="Suchen"/>
</form>
<?php 
 
 //Prüft ob im Feld "suchfeld" etwas eingeben wurde. 
 //Falls ja gehts weiter in die if Schleife
 if(isset($_POST["suchfeld"])) {

    //Werte von der Eingabe im "suchfeld" werden in $searchfile übergeben
    $searchfile = $_POST["suchfeld"];
        //Prüft ob es sich um eine Datei handelt.
        if(is_file($searchfile)){
        
        //Prüft ob die Datei existiert.
        if (file_exists($searchfile)) {
         echo "Datei gefunden <br>";
         //filesize hohlt die Grösse der Datei die anschliessend in die Variable $size gespeichert wird.
         $size = filesize($searchfile);
         //Umrechnung in Kilobyte, 0 steht Ziffern nach dem Komma
         $fileSize = round($size / 1024,0);
         //Ausgabe
         echo $searchfile . ': ' . $fileSize . ' KB';
        } 
        else 
        {
        //Falls die Datei nicht existiert wird diese Ausgabe erfolgen.
        echo "Die Datei $searchfile existiert nicht";
        }
    }
    else 
    {
        //Falls es sich nicht um eine Datei handelt erfolgt diese Ausgabe
        echo "Dies ist keine Datei.";
    }
}
 ?>
 
<div>
<!-- Canvas Tag eginet sich für die Darstellung von Grafiken und Zeichnungen -->
<canvas id="barChartFiles"></canvas>
</div>

<table border=3>
  <tr>
    <!--Text für die Tabelle-->
    <th class=tableheader1>Ordner / Datei Name</th>
    <th class=tableheader2>Grösse in KB</th>
  </tr>
</table>