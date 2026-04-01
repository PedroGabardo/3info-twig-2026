<?php 



require('carregar_pdo.php');

$erro = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (INT) $_POST['id'] ?? false;

    if ($id) {
        $nome = $_POST['nome'] ?? false;
        $estilo = $_POST['estilo'] ?? false;

        if (!$nome || !$estilo) {
            $erro = 'Preenche o formulário direito, chinelão!';
        } else {
            $ext = pathinfo($_FILES['capa']['full_path'], PATHINFO_EXTENSION);
            $capa = uniqid().'.'.$ext;

            move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

            require('carregar_pdo.php');
            $dados = $pdo->prepare('UPDATE jogos SET nome = :nome, estilo = :estilo,  capa = :capa, WHERE id = :id');

            $dados->bindParam(':nome', $nome);
            $dados->bindParam(':estilo', $estilo);
            $dados->bindParam(':capa', $capa);
            $dados->bindParam(':id', $id);  

            $dados->execute();

            header('location:jogos.php');
            die;
        }
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

echo $twig->render('jogos_editar.html', [
    'jogo' => $jogo,
    'erro' => $erro
]);