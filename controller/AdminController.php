<?php
require_once ('libs/dompdf/autoload.inc.php');
require_once('libs/jpgraph/src/jpgraph.php');
require_once('libs/jpgraph/src/jpgraph_line.php');
use Dompdf\Dompdf;


class AdminController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function pdf()
    {

// instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml('hello world');       //aca van los graficos

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream("document.pdf" , ['Attachment' => 0]);


    }


}
