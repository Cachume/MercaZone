<?php
    require_once("./app/models/reportmodel.php");
    require 'vendor/autoload.php';
    use Dompdf\Dompdf;
    class Reportes{
        public $data;
        public function __construct(){
            if(!isset($_SESSION['id_user'])){
                header('Location:/');
                return;
            }
        }
        public function default() {
            header("Location: /");
            exit();
        }

        public function ventas() {
            $this->data= ReportModel::reportSell($_SESSION['id_user']);
            ob_start();
            include './app/views/reports/sells.php';
            $html = ob_get_clean();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("informe_ventas_mes.pdf", ["Attachment" => true]);
            require_once './app/views/reports/sells.php';
        }
    }