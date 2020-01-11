<?php
session_start();
include('../config/conection.php');
include('../config/compruebasesion.php');
        $codusuario=$_SESSION["idusuario"];
        $codvuelo=$_GET["codvuelo"];
        $comprobar="SELECT ccodvuelo FROM compra WHERE ccodvuelo='$codvuelo' AND cidusuario='$codusuario';";
        $result=$connection->query($comprobar);
            if ($result->num_rows==0) {
                header("Location:../index.php");
            }else{
                $consultavuelo="SELECT * FROM vuelo, usuario, compra, equipaje WHERE codvuelo = '$codvuelo' AND idusuario='$codusuario';";
                $result2=$connection->query($consultavuelo);
                while($obj = $result2->fetch_object()) {
                    $vuelo=$obj->codvuelo;
                    $origen=$obj->codaerori;
                    $destino=$obj->codaerdes;
                    $fecha=$obj->fecha;
                    $hora=$obj->hora;
                    $nombre=$obj->nombre;
                    $apellidos=$obj->apellidos;
                    $email=$obj->email;
                    $maleta=$obj->cidmaleta;
                    $tipomaleta=$obj->tipo;
                }
                $consultaaeropuertoorigen="SELECT * FROM aeropuerto WHERE codaer='$origen';";
                $result3=$connection->query($consultaaeropuertoorigen);
                while($obj2 = $result3->fetch_object()) {
                    $nombreorigen=$obj2->nombre;
                    $ciudadorigen=$obj2->ciudad;
                }
                $consultaaeropuertodestino="SELECT * FROM aeropuerto WHERE codaer='$destino';";
                $result4=$connection->query($consultaaeropuertodestino);
                while($obj3 = $result4->fetch_object()) {
                    $nombredestino=$obj3->nombre;
                    $ciudadestino=$obj3->ciudad;
                }
require('../config/fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','b',12);
$pdf->Image('../img/logo2.JPG' , 10 ,10, 80 , 20,'JPG');
$pdf->Ln(20);
$pdf->SetTextColor(132,146,146);
$pdf->Cell(40,10,'Airline. Fly premium, fly cheap.','C');
$pdf->Ln(20);
$pdf->SetFont('Arial','bui',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,10,'Datos de la reserva:','C');
$pdf->Ln(10);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Nombre:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$nombre);
$pdf->Cell(10,10,$apellidos);
$pdf->Ln(10);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Email:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$email);
$pdf->Ln(20);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Vuelo:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,10,$codvuelo);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Fecha:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,$fecha);
$pdf->Cell(10,10,$hora);
$pdf->Ln(10);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Origen:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$origen);
$pdf->Cell(60,10,$nombreorigen);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Ciudad:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,$ciudadorigen);
$pdf->Ln(10);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Destino:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$destino);
$pdf->Cell(60,10,$nombredestino);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(20,10,'Ciudad:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,$ciudadestino);
$pdf->Ln(20);
$pdf->SetFont('Arial','u',10);
if($tipomaleta == 'sin maleta'){
$pdf->Cell(45,10,'Identificador de Equipaje:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'0000');
$pdf->SetFont('Arial','u',10);
$pdf->Cell(30,10,'Tipo de Equipaje:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,'Sin equipaje.');
}else{
$pdf->Cell(45,10,'Identificador de Equipaje:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$maleta);
$pdf->SetFont('Arial','u',10);
$pdf->Cell(30,10,'Tipo de Equipaje:');
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,$tipomaleta);
};
$pdf->Ln(40);
$pdf->SetFont('Arial','bui',10);
$pdf->Cell(40,10,'Informacion y contacto:','C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,'Recuerde llevar este comprobante de reserva impreso antes de acceder al aeropuerto. Le sera requerido para poder ');
$pdf->Ln(4);
$pdf->Cell(10,10,'facturar y acceder al vuelo. Sera necesaria tambien alguna acreditacion que demuestre su identidad. Gracias.');
$pdf->Ln(10);
$pdf->Cell(30,10,'');
$pdf->Cell(60,10,'www.airline-iaw.netne.net','C');
$pdf->Cell(10,10,'administrador@airline.es','C');
$pdf->Output();
            };
?>
