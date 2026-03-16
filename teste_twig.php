<?php

require('carregar_twig.php');

$nome = 'Pedro';
$disciplinas = [
    'Programação',
    'Banco de dados',
    'Interface web',
    'Desenvolvimento de Sistemas',
];
$letra = 'Teria paz se não tivesse sangue
Se o coração não conseguisse trabalhar
Esqueceria tudo do começo
E viveria toda a vida sem pensar
Não tomaria tantos comprimidos
Apagaria o que me dessem pra fumar
Talvez tudo fizesse algum sentido
Talvez o que é sentido possa se apagar
Apaga do teu coração
As marcas de um tempo atrás
E saiba que eu não sei viver
Com o estrago que o tempo faz
Eu tento me esconder em ar aberto
E ter por perto quem me abraça sem cobrar
Os comprimidos não me compreendem
E não esqueço o que paguei para apagar
Queria estar no teu lugar agora
Só pra entender como é estar no meu lugar
Queria estar no teu lugar agora
Só pra entender como é me ver de fora
Me diga que não quer sair
Que tem a chave para entrar
Que resolveu a equação
Que sabe como me tirar do fundo
E sabe como me salvar do mundo
Aunque puedo caminar, correr y volar, no me muevo
Todo lo que eres para mi, elimina la adaga en mi corazón
Y saca la muerte de mi vida.
Teria paz se não tivesse sangue
Se o coração não conseguisse trabalhar';

echo $twig->render('teste_twig.html', [
    'nome' => $nome,
    'legal' => true,
    'disciplinas' => $disciplinas,
    'letra' => $letra,
]); 