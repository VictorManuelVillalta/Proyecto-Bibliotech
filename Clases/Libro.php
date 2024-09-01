<?php

class Libro {
    private $titulo;
    private $autor;
    private $categoria;
    private $isbn;
    private $prestado;

    public function __construct($titulo, $autor, $categoria, $isbn, $prestado = false) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->isbn = $isbn;
        $this->prestado = $prestado;
    }

    // Getters y Setters
    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getPrestado() {
        return $this->prestado;
    }

    public function setPrestado($prestado) {
        $this->prestado = $prestado;
    }
}
?>