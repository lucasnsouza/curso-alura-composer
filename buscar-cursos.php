#!/usr/bin/env php
<?php
require 'vendor/autoload.php';


//O pacotes guzzlehttp/guzzle serve para executar requisições HTTP de alto nível
use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

//instanciando objeto client do guzzle, definindo uma url base de onde a requisição http será feita
$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

//loop para iterar sobre os cursos encontrados pelo crawler e exibi-los
foreach ($cursos as $curso) {
    exibeMensagem($curso);
}