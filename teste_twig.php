<?php

require('carregar_twig.php');

$nome = 'Pedro';
$disciplinas = [
    'Programação',
    'Banco de dados',
    'Interface web',
    'Desenvolvimento de Sistemas',
];

echo $twig->render('teste_twig.html', [
    'nome' => $nome,
    'legal' => true,
    'disciplinas' => $disciplinas
]); 