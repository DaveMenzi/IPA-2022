<?php 

//Bindet die Dateien ein falls sie noch nicht eingebunden wurden.
require_once "Obj/Ordner.php";
require_once "Obj/Datei.php";
require_once "Obj/Element.php";

class Index{

    //Definierung der statischen Variablen $allFliles, $allElements
    public static $allFiles;
    public static $allElements;

    //PHP ruft diese Funktion automatisch auf, wenn Sie ein Objekt aus einer Klasse erstellen.
    // Inizialisiert die Applikation und führt alle Funktionen aus die benötigt werden.
    public function __construct() {

        //Prüft ob der get Parameter gesetzt ist.
        if (isset($_GET['path'])) {
            //Eingabe von der URL wird in der Variablen $input gespeichert
            $input = $_GET['path'];
                
            //Prüft mit der Funktion checkpath ob es sich hier um ein Verzeichnis handelt.
            if ($this->checkpath($input)) {
                $ordner = new Ordner($input, "folder");
                $this->displayOutput($ordner);
            } else {
                //Falls die Eingabe kein gültiger Pfad ist wird diese Fehlermeldung ausgegeben.
                echo "Path does not exist";
                return;
            }
        //Falls der Pfad noch nicht eingegeben/gesetzt wurde erfolgt diese Ausgabe
        } else {
            echo "<h3>PHP File Analyzer</h3><br>";
            echo "Path not set<br>";
            echo "Type <strong> ?=yourpath\ </strong> to set a path<br>";
            echo "Type <strong> &export=yes </strong> at the end for export in a .txt file";
        }
    }


    public function checkpath($path) {
        //is_dir — Prüft, ob der angegebene Dateiname ein Verzeichnis ist
        return is_dir($path);
    }

    public function displayOutput($ordner) {
        include "indexHTML.php";
        //Werte von $ordner die mit der Funktion displaySizes() ausgeführt wurden werden in $elms gespeichert.
        $elms = $ordner->displaySizes();
        //foreach Schleife
        foreach ($elms as $elm) {
            //$elm scannt rekursiv alle Grössen der Dateien und Ordner
            $elm->size();
        }

        //Wenn eine Eingabe im 2 Parameter gemacht wurde dann:
            if (isset($_GET['export'])){
                //fopen Öffnet eine Datei oder URL, diesem fall export.txr
                // das 'w' steht für:
                //Nur zum Schreiben geöffnet; platziere den Dateizeiger auf den Dateianfang 
                //und kürze die Datei auf eine Länge von 0. Existiert die Datei nicht, versuche, diese zu erzeugen.
                //Quelle: https://www.php.net/manual/de/function.fopen.php
                $export = fopen('export.txt', 'w');

                //foreach mit der statischen Variable $allElements 
                foreach (Index::$allElements as $file) {
                    //schreibt den Inhalt der Klammern in eine Datei.
                    fwrite($export, $file->getPath() . ': ' . $file->size . "\n");
                }
        }

        //Sortiert ein Array nach Werten mittels einer  Vergleichsfunktion
        usort(Index::$allFiles, 
            function($a, $b) {
                return $a->size < $b->size;
            }
        );
        //Hohlt die 10 Grössten Dateien
        $largestFiles = array_slice(Index::$allFiles, 0, 10);
        
        //indexHTML.php wird mit include hier eingebunden
        include "indexJS.php";
    }
}

//Klass Index wird inizialisiert 
$index = new Index();
?>