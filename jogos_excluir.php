<?php

require('carregar_pdo.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (INT) $_POST['id'] ?? false;
    if ($id) {
        $excluir = $pdo->prepare('DELETE FROM JOGOS WHERE id = :id');
        $excluir->bindParam(':id', $id);
        $excluir->execute();
    }
    header('location:jogos.php');
    die;
}

$id = (INT) $_GET['id'] ?? false;

if (!$id) {
    header('location:jogos.php');
    die;
}

require('carregar_twig.php');

$dados = $pdo->prepare('SELECT * FROM JOGOS WHERE id = :id');
$dados->execute([':id'=> $id]);

if ($dados->rowCount() !=1) {
    header('location:jogos.php');
    die;
}

$jogo = $dados->fetch(PDO::FETCH_ASSOC);  

echo $twig->render('jogos_excluir.html', [
    'jogo' => $jogo,
]); 


