<?php 

//Prüft hier ob die gewünschte Datei bereits eingebunden wurde.
require_once "Element.php";
require_once "Ordner.php";

//Vererbung an die Klasse Element (extends)
// + Erstellen der Klasse Datei
class Datei extends Element {

    //Inizialisierung der Variable
    public $size;
    public $sizeMB;

    //Funktion, hohlt die Dateigrössen von dem Pfad 
    public function size() {
        //hohlt die Filesize von dem Pfad und speichered die Werte in diese $size Variable.
        $this->size = filesize($this->getPath());
        //Rechnet die Grösse von $this->size in MB um un speichert die Werte in $this->sizeMB
        $this->sizeMB = round($this->size / 1024 / 1024,2);

        //Ausgabe in einer Tabelle
        echo "<table border=1>";
        echo "<tr>";
        echo "<td class=tddateiborder>" . $this->getPath() . "</td>";
        echo "<td class=tddatei>" . $this->size . "</td>";
        echo "</tr>";
        echo "</table>";
        //Rückgabewert
        return $this->size; 
    }
}

?>