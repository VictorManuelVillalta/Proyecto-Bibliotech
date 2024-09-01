<?php
require './Clases/Biblioteca.php';
require './Clases/Libro.php';

$miBiblioteca = new Biblioteca();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['agregar'])) {
        // Agregar nuevo libro
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];
        $isbn = $_POST['isbn'];

        $nuevoLibro = new Libro($titulo, $autor, $categoria, $isbn);
        $miBiblioteca->agregarLibro($nuevoLibro);

        echo "Libro agregado correctamente!";
    } elseif (isset($_POST['buscar'])) {
        // Buscar libros
        $termino = $_POST['termino'];
        $resultados = $miBiblioteca->buscarLibros($termino);

        if (empty($resultados)) {
            echo "No se encontraron libros que coincidan con '$termino'.";
        } else {
            echo "Libros encontrados:<br>";
            foreach ($resultados as $libro) {
                echo "Título: " . $libro->getTitulo() . "<br>";
                echo "Autor: " . $libro->getAutor() . "<br>";
                echo "Categoría: " . $libro->getCategoria() . "<br>";
                echo "ISBN: " . $libro->getIsbn() . "<br>";
                echo "Estado: " . ($libro->getPrestado() ? "Prestado" : "Disponible") . "<br><br>";
            }
        }
    } elseif (isset($_POST['prestar'])) {
        // Solicitar préstamo de libro
        $isbn = $_POST['isbn_prestamo'];
        $mensaje = $miBiblioteca->solicitarPrestamo($isbn);

        echo $mensaje;
    }
}
?>

<!-- Formulario para agregar libros -->
<h2>Agregar Libro</h2>
<form method="post" action="">
    Título: <input type="text" name="titulo" required><br>
    Autor: <input type="text" name="autor" required><br>
    Categoría: <input type="text" name="categoria" required><br>
    ISBN: <input type="text" name="isbn" required><br>
    <input type="submit" name="agregar" value="Agregar Libro">
</form>

<!-- Formulario para buscar libros -->
<h2>Buscar Libros</h2>
<form method="post" action="">
    Término de búsqueda: <input type="text" name="termino" required><br>
    <input type="submit" name="buscar" value="Buscar Libros">
</form>

<!-- Formulario para solicitar préstamo de libro -->
<h2>Solicitar Préstamo</h2>
<form method="post" action="">
    ISBN del libro: <input type="text" name="isbn_prestamo" required><br>
    <input type="submit" name="prestar" value="Prestar Libro">
</form>