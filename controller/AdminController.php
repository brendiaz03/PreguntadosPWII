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



}
