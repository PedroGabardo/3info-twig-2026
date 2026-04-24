<?php 

require('carregar_twig.php');
require('carregar_pdo.php');
use Carbon\Carbon;

$jogos = $pdo->query('SELECT * FROM jogos');
$todosjogos = $jogos->fetchAll(PDO::FETCH_ASSOC);

foreach ($todosjogos as &$jogo) {
    $jogo['lancamento'] = Carbon::parse($jogo ['lancamento'])->locale('pt-BR')->isoFormat('LL'); 
}

$hoje = Carbon::now();
$proxsexta = Carbon::now()->next('friday');
$daq20 = Carbon::now()->add(20, 'day');


echo $twig->render('jogos.html', [
    'jogos' => $todosjogos,
    'hoje' => $hoje,
    'proxsexta' => $proxsexta,
    'daq20' => $daq20,
]);
 