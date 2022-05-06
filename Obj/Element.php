<?php 

class Element {
    //Inizialisierung der privaten Variablen $path und $filetype 
    private $path; 
    private $filetype;

    //PHP ruft diese Funktion automatisch auf, wenn Sie ein Objekt aus einer Klasse erstellen.
    //Automatische Aufrufungen der Funktion $path und $filetype mit __construct
    public function __construct($path, $filetype) {
        $this->path = $path;
        $this->filetype = $filetype;
    }
    //Funktion gibt den Wert von $path entsprechend zurück.
    public function getPath() {
        return $this->path;
    }
    //Funktion gibt den Wert von $filetype entsprechend zurück.
    public function getFiletype() {
        return $this->filetype;
    }
}
?>