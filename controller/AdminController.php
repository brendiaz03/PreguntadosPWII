<?php
class AdminController
{
    private $model;
    private $presenter;

    private $textoNav = "Home";

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;

    }

    public function traerJugadores()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "Home";
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
        $tablaUsuarios = $this->model->imprimirTodosLosJugadores();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaUsuarios as $fila) {
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
        $textoNav = "Home";

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
        $tablaPartidas = $this->model->imprimirTodasLasPartidas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        //Centrar tabla
        $anchoTotalTabla = 25 + 25 + 45 + 70;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTotalTabla) / 2;

        foreach ($tablaPartidas as $fila) {
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
        $textoNav = "Home";

        $this->presenter->render("view/preguntasEstadistica.mustache", ['preguntasDelJuego' => $preguntas, "logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reporteDePreguntas()
    {
        require("helper/Pregunta.php");

        $pdf = new Pregunta("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tablaPreguntas = $this->model->imprimirTodasLasPreguntas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);
        $pdf->SetTitle("Preguntas Totales");

        foreach ($tablaPreguntas as $fila) {
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
        $textoNav = "Home";

        $this->presenter->render("view/preguntasEnJuegoEstadistica.mustache", ['preguntasActivas' => $preguntasAct,"logeado" => true,"textoNav" => $textoNav,"foto" => $usuario['foto']]);
    }

    public function reportePreguntasActivas()
    {
        require('helper/Pregunta.php');

        $pdf = new Pregunta("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Preguntas Totales En Juego");
        $tablaPreguntas = $this->model->imprimirTodasLasPreguntasActivas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaPreguntas as $fila) {
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
}
