<?php
session_start();
include('../config/conection.php');
include('../config/compruebasesion.php');
include('../config/compruebausuario.php');
require('../config/fpdf181/fpdf.php');
$variable=$_GET["cod"];
$altura=76;
if($variable=='aeropuertos'){
class PDF extends FPDF
{
    function cabecera($title)
    {
        $this->SetXY(42, 70);
        $this->SetFont('Arial','B',10);
        foreach($title as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(40,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
    function datos($datos)
    {
        global $altura;
        $this->SetXY(42,$altura); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',10); //Fuente, normal, tamaño
        foreach($datos as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(40,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
} // FIN Class PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','b',12);
$pdf->Image('../img/logo2.JPG' , 10 ,10, 80 , 20,'JPG');
$pdf->Ln(20);
$pdf->SetTextColor(132,146,146);
$pdf->Cell(40,10,'Airline. Fly premium, fly cheap.','C');
$pdf->Ln(20);
$pdf->SetFont('Arial','bui',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,10,'Datos de los aeropuertos:','C');
$pdf->Ln(10);
$titulos = array('Codigo','Nombre','Ciudad');
$pdf->cabecera($titulos);
$consulta="SELECT * FROM aeropuerto;";
$result=$connection->query($consulta);
                    while($obj = $result->fetch_object()) {
                        $datostabla = array($obj->codaer,$obj->nombre,$obj->ciudad);
                        $pdf->datos($datostabla);
                        if($altura>264){
                            $pdf->AddPage();
                            $altura=6;
                        }else{
                        $altura=($altura+6);
                        };
                    };
$pdf->Output(); //Salida al navegador
    
}elseif($variable=='vuelos'){
 class PDF extends FPDF
{
    function cabecera($title)
    {
        $this->SetXY(30, 70);
        $this->SetFont('Arial','B',10);
        foreach($title as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(20,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
    function datos($datos)
    {
        global $altura;
        $this->SetXY(30,$altura); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',10); //Fuente, normal, tamaño
        foreach($datos as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(20,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
} // FIN Class PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','b',12);
$pdf->Image('../img/logo2.JPG' , 10 ,10, 80 , 20,'JPG');
$pdf->Ln(20);
$pdf->SetTextColor(132,146,146);
$pdf->Cell(40,10,'Airline. Fly premium, fly cheap.','C');
$pdf->Ln(20);
$pdf->SetFont('Arial','bui',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,10,'Datos de los vuelos:','C');
$pdf->Ln(10);
$titulos = array('Codigo','Origen','Destino','Fecha','Hora','Capacidad','Libres');
$pdf->cabecera($titulos);
$consulta="SELECT * FROM vuelo;";
$result=$connection->query($consulta);
                    while($obj = $result->fetch_object()) {
                        $datostabla = array($obj->codvuelo,$obj->codaerori,$obj->codaerdes,$obj->fecha,$obj->hora,$obj->capacidad,$obj->libres);
                        $pdf->datos($datostabla);
                        if($altura>264){
                            $pdf->AddPage();
                            $altura=6;
                        }else{
                        $altura=($altura+6);
                        };
                    };
$pdf->Output(); //Salida al navegador   
}elseif($variable=='clientes'){
class PDF extends FPDF
{
    function cabecera($title)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($title as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(46,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
    function datos($datos)
    {
        global $altura;
        $this->SetXY(10,$altura); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',9); //Fuente, normal, tamaño
        foreach($datos as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(46,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
} // FIN Class PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','b',12);
$pdf->Image('../img/logo2.JPG' , 10 ,10, 80 , 20,'JPG');
$pdf->Ln(20);
$pdf->SetTextColor(132,146,146);
$pdf->Cell(40,10,'Airline. Fly premium, fly cheap.','C');
$pdf->Ln(20);
$pdf->SetFont('Arial','bui',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,10,'Datos de los usuarios:','C');
$pdf->Ln(10);
$titulos = array('Nombre','Apellidos','Id','email');
$pdf->cabecera($titulos);
$consulta="SELECT * FROM usuario;";
$result=$connection->query($consulta);
                    while($obj = $result->fetch_object()) {
                        $datostabla = array($obj->nombre,$obj->apellidos,$obj->idusuario,$obj->email);
                        $pdf->datos($datostabla);
                        if($altura>264){
                            $pdf->AddPage();
                            $altura=6;
                        }else{
                        $altura=($altura+6);
                        };
                    };
$pdf->Output(); //Salida al navegador
    
}elseif($variable=='reservas'){
class PDF extends FPDF
{
    function cabecera($title)
    {
        $this->SetXY(42, 70);
        $this->SetFont('Arial','B',10);
        foreach($title as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(40,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
    function datos($datos)
    {
        global $altura;
        $this->SetXY(42,$altura); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
        $this->SetFont('Arial','',10); //Fuente, normal, tamaño
        foreach($datos as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            $this->Cell(40,6, utf8_decode($fila),1, 0 , 'L' );
        }
    }
} // FIN Class PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','b',12);
$pdf->Image('../img/logo2.JPG' , 10 ,10, 80 , 20,'JPG');
$pdf->Ln(20);
$pdf->SetTextColor(132,146,146);
$pdf->Cell(40,10,'Airline. Fly premium, fly cheap.','C');
$pdf->Ln(20);
$pdf->SetFont('Arial','bui',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,10,'Datos de las reservas:','C');
$pdf->Ln(10);
$titulos = array('Codigo Vuelo','Id. Maleta','Usuario');
$pdf->cabecera($titulos);
$consulta="SELECT * FROM compra;";
$result=$connection->query($consulta);
                    while($obj = $result->fetch_object()) {
                        $datostabla = array($obj->ccodvuelo,$obj->cidmaleta,$obj->cidusuario);
                        $pdf->datos($datostabla);
                        if($altura>264){
                            $pdf->AddPage();
                            $altura=6;
                        }else{
                        $altura=($altura+6);
                        };
                    };
$pdf->Output(); //Salida al navegador
    
}else{
header('Location: ../index.php');  
};
?>
