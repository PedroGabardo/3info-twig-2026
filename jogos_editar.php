<?php 



require('carregar_pdo.php');

$erro = false;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    require('carregar_pdo.php');

    $id = (INT) $_POST['id'] ?? false;
    $nome = $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;

    }
        if (!$nome || !$estilo || !$id) {
            $erro = 'Preenche o formulário direito, chinelão!';
        } else {

        if($_FILES['capa']['error']) {
        $dados = $pdo->prepare('SELECT capa FROM jogos WHERE id=:id');
        $dados->execute([':id' => $id]);
        $capa_velha = $dados->fetch(PDO::FETCH_ASSOC)['capa'];

        $capa_velha = __DIR__ . '/img/' . $capa_velha;
        if(file_exists($capa_velha)) {
            unlink($capa_velha);
        }

        $ext = pathinfo($_FILES['capa']['full_path'], PATHINFO_EXTENSION);
        $capa = uniqid().'.'.$ext;
        move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

        $sql = (' UPDATE jogos SET nome = :nome, estilo = :estilo' . (isset($capa) ? ', capa = :capa' : '') . ' WHERE id = :id ');
        
        $dados = $pdo->prepare($sql);
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':estilo' => $estilo,
        ];

        if (isset($capa)) $params[':capa'] = $capa;

        $dados->execute($params);

        header('location:jogos.php');
        die;
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