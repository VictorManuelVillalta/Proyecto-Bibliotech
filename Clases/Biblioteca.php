<?php

class Biblioteca {
    private $libros = [];
    private $archivoJSON = 'libros.json';

    // Constructor para cargar los libros desde el archivo JSON
    public function __construct() {
        $this->cargarLibrosDesdeJSON();
    }

    // Método para agregar un libro a la biblioteca
    public function agregarLibro(Libro $libro) {
        $this->libros[] = $libro;
        $this->guardarLibrosEnJSON(); 
    }

    // Método para buscar libros por título, autor o categoría
    public function buscarLibros($termino) {
        $resultados = [];

        foreach ($this->libros as $libro) {
            if (stripos($libro->getTitulo(), $termino) !== false ||
                stripos($libro->getAutor(), $termino) !== false ||
                stripos($libro->getCategoria(), $termino) !== false) {
                $resultados[] = $libro;
            }
        }

        return $resultados;
    }

    // Método para solicitar el préstamo de un libro
    public function solicitarPrestamo($isbn) {
        foreach ($this->libros as &$libro) {
            if ($libro->getIsbn() === $isbn) {
                if ($libro->getPrestado() === false) {
                    $libro->setPrestado(true);
                    $this->guardarLibrosEnJSON();
                    return "El libro ha sido prestado exitosamente.";
                } else {
                    return "El libro ya está prestado.";
                }
            }
        }
        return "El libro con ISBN $isbn no fue encontrado.";
    }

    // Método para cargar los libros desde un archivo JSON
    private function cargarLibrosDesdeJSON() {
        if (file_exists($this->archivoJSON)) {
            $jsonData = file_get_contents($this->archivoJSON);
            $librosArray = json_decode($jsonData, true);

            foreach ($librosArray as $libroData) {
                $this->libros[] = new Libro(
                    $libroData['titulo'], 
                    $libroData['autor'], 
                    $libroData['categoria'], 
                    $libroData['isbn'],
                    $libroData['prestado'] ?? false 
                );
            }
        }
    }

    // Método para guardar los libros en el archivo JSON
    private function guardarLibrosEnJSON() {
        $librosArray = [];

        foreach ($this->libros as $libro) {
            $librosArray[] = [
                'titulo' => $libro->getTitulo(),
                'autor' => $libro->getAutor(),
                'categoria' => $libro->getCategoria(),
                'isbn' => $libro->getIsbn(),
                'prestado' => $libro->getPrestado(), 
            ];
        }

        $jsonData = json_encode($librosArray, JSON_PRETTY_PRINT);
        file_put_contents($this->archivoJSON, $jsonData);
    }
}
?>