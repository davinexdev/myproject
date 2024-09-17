<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);


require 'php/db.php';


$consulta_id = $_GET['id'];


$stmt = $pdo->prepare('SELECT c.id, p.nome AS paciente, m.nome AS medico, c.data_hora, c.motivo
                       FROM consultas c
                       JOIN pacientes p ON c.paciente_id = p.id
                       JOIN medicos m ON c.medico_id = m.id
                       WHERE c.id = ?');
$stmt->execute([$consulta_id]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);


$html = '
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Detalhes da Consulta</h1>
    <table>
        <tr>
            <th>Paciente</th>
            <td>' . htmlspecialchars($consulta['paciente']) . '</td>
        </tr>
        <tr>
            <th>Médico</th>
            <td>' . htmlspecialchars($consulta['medico']) . '</td>
        </tr>
        <tr>
            <th>Data e Hora</th>
            <td>' . htmlspecialchars($consulta['data_hora']) . '</td>
        </tr>
        <tr>
            <th>Descrição</th>
            <td>' . htmlspecialchars($consulta['motivo']) . '</td>
        </tr>
    </table>
</body>
</html>';


$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');


$dompdf->render();


$dompdf->stream('consulta_' . $consulta_id . '.pdf', array('Attachment' => 0));
