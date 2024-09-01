<?php

class Autor {
    public $id;
    public $nombre;
    public $biografia;

    public function __construct($id, $nombre, $biografia = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->biografia = $biografia;
    }
}

?>