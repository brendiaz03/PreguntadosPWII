<?php
class AdminController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function traerJugadores()
    {
        $jugadores = $this->model->getAllJugadores();
        $totalUsuarios = count($jugadores);

        foreach ($jugadores as &$jugador) {
            if ($jugador['cantidadPreguntas'] > 0) {
                $jugador['porcentaje'] = ($jugador['puntaje'] / $jugador['cantidadPreguntas']) * 100; //traemos el porcentaje de respuestas correctas por las respuestas totales
            } else {
                $jugador['porcentaje'] = 0; // Si el jugador no tiene respuestas, no se calcula el porcentaje
            }
        }

        $this->presenter->render("view/jugadores.mustache", ['totalUsuarios' => $totalUsuarios, 'jugadores' => $jugadores,]);
    }

    public function reporteDeJugadores()
    {
        require("helper/Jugadores.php");

        $pdf = new Jugadores("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Usuarios registrados");
        $tablaUsuarios = $this->model->imprimirTodosLosJugadoresParaPDF();

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

}
