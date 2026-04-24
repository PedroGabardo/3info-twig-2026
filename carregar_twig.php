<?php

require_once('vendor/autoload.php');

$loader = new \Twig\loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);