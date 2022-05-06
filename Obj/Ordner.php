<?php

//Bindet die Dateien ein falls sie noch nicht eingebunden wurden.
require_once "Element.php";
require_once "Datei.php";

//Vererbung an die Klasse Element (extends)
// + Erstellen der Klasse Ordner
class Ordner extends Element {

    public $size;
    //Funktion um die 2 Funktionen (getElements, getPath) zurückgibt
    public function displaySizes() {
        return $this->getElements($this->getPath());
    }

    public function size() {
        $elms = $this->getElements($this->getPath());
        $size = 0;

        foreach($elms as $elm) {
            $size += $elm->size();
        }
        $this->size = $size;
        Index::$allElements[] = $this;

        //Ausgabe von dem Pfad und von der $size Variable
        echo "<table border=1>";
        echo "<tr>";
        echo "<td class=tdordnerborder>" . $this->getPath() . "</td>";
        echo "<td class=tdordner>" . $size . "</td>";
        echo "</tr>";
        echo "</table>";
        return $size;
    }

    private function getElements($path) {
        //scandir() Listet Dateien und Verzeichnisse innerhalb eines angegebenen Pfades auf
        $es = scandir($path); 
        //Initialisierung eines leeren Arrays
        $elms = [];

        foreach($es as $e) {
            // Wenn das Programm . oder .. findet dann wird es einfach fortgesetzt
            if ($e == "." || $e == "..") {
                continue;
            }

            //Prüft, ob der Dateiname eine reguläre Datei ist
            if (is_file($path. "/" . $e)) {
                //Neues Objekt der Klasse Datei wurde erstellt.
                $file = new Datei($path . "/" . $e, "file");
                //Speichert die Werte von $file in das Array $elms[]
                $elms[] = $file;
                //Werte von $file werden dem statischem Array hinzugefügt
                Index::$allFiles[] = $file;
                //Werte von $file werden dem statischem Array hinzugefügt
                Index::$allElements[] = $file;
                if (isset($_GET['suchfeld']) && strlen($_GET['suchfeld']) > 0) {
                    if(strpos($e, $_GET['suchfeld']) !== false) {
                        Index::$searchFiles[] = $file;
                    }
                }
            } else { 
                $folder = new Ordner($path . "/" . $e, "folder");
                $elms[] = $folder; 
            }
        }
    //$elms als Rückgabewert
    return $elms;
    }
}

?>