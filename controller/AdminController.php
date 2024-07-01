<?php
class AdminController
{
    private $model;
    private $presenter;

    private $textoNav = "";

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;

    }

    public function traerJugadores()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA JUGADORES";
        $jugadores = $this->model->getAllJugadores();
        $totalUsuarios = count($jugadores);

        foreach ($jugadores as &$jugador) {
            if ($jugador['cantidadPreguntas'] > 0) {
                $jugador['porcentaje'] = ($jugador['puntaje'] / $jugador['cantidadPreguntas']) * 100; //traemos el porcentaje de respuestas correctas por las respuestas totales
            } else {
                $jugador['porcentaje'] = 0; // Si el jugador no tiene respuestas, no se calcula el porcentaje
            }
        }

        $this->presenter->render("view/jugadoresEstadistica.mustache", ['totalUsuarios' => $totalUsuarios, 'jugadores' => $jugadores,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reporteDeJugadores()
    {
        require("helper/Jugador.php");


        $pdf = new Jugador("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Usuarios registrados");
        $tabla = $this->model->imprimirTodosLosJugadores();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tabla as $fila) {
            $pdf->Cell(25, 25, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 25, ($fila["nombreUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(60, 25, ($fila["mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 25, ($fila["sexo"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 25, ($fila["anioNacimiento"]), 1, 0, 'C', 0);
            $pdf->Cell(50, 25, ($fila["fechaRegistro"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 25, ($fila["puntaje"]), 1, 0, 'C', 0);
            $pdf->Ln();
        }

        $pdf->Output('JugadoresTotales.pdf', 'I');
    }

    public function traerPartidas()
    {
        $partidas = $this->model->getAllPartidas();
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA PARTIDAS";

        $totalPartidas = count($partidas);

        $this->presenter->render("view/partidasEstadistica.mustache", ['partidas' => $partidas,
            'totalPartidas' => $totalPartidas,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reporteDePartidas()
    {
        require("helper/Partida.php");

        $pdf = new Partida();
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetTitle("Partida totales");
        $tabla = $this->model->imprimirTodasLasPartidas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        //Centrar tabla
        $anchoTotalTabla = 25 + 25 + 45 + 70;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTotalTabla) / 2;

        foreach ($tabla as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->SetX($margenIzquierdo);
            $pdf->Cell(25, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(25, 10, ($fila["idUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 10, ($fila["puntaje"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 10, ($fila["fechaRealizado"]), 1, 0, 'C', 0);
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PartidasTotales.pdf', 'I');
    }

    public function traerPreguntas()
    {
        $preguntas = $this->model->getAllPreguntas();
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA PREGUNTAS";

        $this->presenter->render("view/preguntasEstadistica.mustache", ['preguntasDelJuego' => $preguntas, "logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reporteDePreguntas()
    {
        require("helper/Pregunta.php");

        $pdf = new Pregunta("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tabla = $this->model->imprimirTodasLasPreguntas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);
        $pdf->SetTitle("Preguntas Totales");

        foreach ($tabla as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(10, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(240, 10, utf8_decode(($fila["pregunta"])), 1, 0, 'C', 0);
            $pdf->Cell(30, 10, ($fila["nivel"]), 1, 0, 'C', 0);

            if ($pdf->GetY() > 150) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PreguntasTotales.pdf', 'I');
    }

    public function traerPreguntasEnElJuego()
    {
        $preguntasAct = $this->model->getAllPreguntasActivas();
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA PREGUNTAS EN JUEGO";

        $this->presenter->render("view/preguntasEnJuegoEstadistica.mustache", ['preguntasActivas' => $preguntasAct,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reportePreguntasActivas()
    {
        require('helper/Pregunta.php');

        $pdf = new Pregunta("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Preguntas Totales En Juego");
        $tabla = $this->model->imprimirTodasLasPreguntasActivas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tabla as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(10, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(240, 10, utf8_decode(($fila["pregunta"])), 1, 0, 'C', 0);
            $pdf->Cell(30, 10, ($fila["nivel"]), 1, 0, 'C', 0);

            if ($pdf->GetY() > 150) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PreguntasTotalesEnJuego.pdf', 'I');
    }

    public function traerUsuariosNuevos()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA USUARIOS";

        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['Desde']) ? $_POST['Desde'] : null;
            $fechaHasta = isset($_POST['Hasta']) ? $_POST['Hasta'] : null;
        }

        $usuarios = $this->model->getUsuariosNuevos($fechaDesde, $fechaHasta);

        $this->presenter->render("view/usuariosEstadistica.mustache", ['usuarios' => $usuarios,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reporteUsuarios(){
        require("helper/Usuario.php");

        $pdf = new Usuario("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Usuarios nuevos");
        $fechaDesde = $_POST["fechaDesdeValue"];
        $fechaHasta = $_POST["fechaHastaValue"];

        $tabla = $this->model->imprimirUsuariosNuevos($fechaDesde, $fechaHasta);

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);


        foreach ($tabla as $fila) {
            $pdf->Ln();
            $pdf->Cell(50, 10, utf8_decode(($fila["nombreCompleto"])), 1, 0, 'C', 0);
            $pdf->Cell(40, 10, ($fila["nombreUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(100, 10, ($fila["mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 10, ($fila["nivel"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 10, ($fila["tipoUsuario"]), 1, 0, 'C', 0);


        }
        $pdf->Output('UsuariosNuevos.pdf', 'I');

    }

    public function traerPreguntasRespondidasPorUsuario()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA PREGUNTAS POR USUARIO";
        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['Desde']) ? $_POST['Desde'] : null;
            $fechaHasta = isset($_POST['Hasta']) ? $_POST['Hasta'] : null;
        }

        $respuestasPorUsuario = $this->model->getRespuestasCorrectasPorUsuario($fechaDesde, $fechaHasta);

       $this->presenter->render("view/graficoPreguntas.mustache", ["titulo"=> "Respuestas Correctas por Usuario",'respuestasPorUsuario' =>  $respuestasPorUsuario,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }


    public function traerUsuariosPorPais()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA USUARIOS POR PAIS";
        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['Desde']) ? $_POST['Desde'] : null;
            $fechaHasta = isset($_POST['Hasta']) ? $_POST['Hasta'] : null;
        }

        $respuestasPorUsuario = $this->model->getUsuariosPorPaisFiltradoPorFecha($fechaDesde, $fechaHasta);

        $this->presenter->render("view/graficoPreguntas.mustache", ["titulo"=> "Usuarios por pais",'respuestasPorUsuario' =>  $respuestasPorUsuario,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function traerUsuariosPorSexo()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA USUARIO POR SEXO";
        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['Desde']) ? $_POST['Desde'] : null;
            $fechaHasta = isset($_POST['Hasta']) ? $_POST['Hasta'] : null;
        }

        $respuestasPorUsuario = $this->model->getUsuariosPorSexoFiltradoPorFechaYRol($fechaDesde, $fechaHasta);

        $this->presenter->render("view/graficoPreguntas.mustache", ["titulo"=> "Usuarios por sexo",'respuestasPorUsuario' =>  $respuestasPorUsuario,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function traerUsuariosPorEdad()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "ESTADISTICA USUARIO POR EDAD";
        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['Desde']) ? $_POST['Desde'] : null;
            $fechaHasta = isset($_POST['Hasta']) ? $_POST['Hasta'] : null;
        }

        $respuestasPorUsuario = $this->model->getUsuariosPorEdadFiltradoPorFecha($fechaDesde, $fechaHasta);

        $this->presenter->render("view/graficoPreguntas.mustache", ["titulo"=> "Usuarios por Edad",'respuestasPorUsuario' =>  $respuestasPorUsuario,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function grafico()
    {
        require('helper/Grafico.php');
        $pdf = new Grafico();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $tituloPDF = $_POST['tituloPDF'];
        $titulo = $_POST['titulo'];
        $pdf->SetTitle($tituloPDF);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(190, 30, $titulo, 0, 1, 'C', 0);

        $grafico = $_POST['graficoImagen'];

        $pdf->image($grafico, 0, 50, 200, 0, 'png');
        $pdf->Output();
    }

}
