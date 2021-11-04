<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private $httpCliente;
    private $crawler;

    public function __construct(ClientInterface $httpCliente, Crawler $crawler)
    {
        $this->httpCliente = $httpCliente;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        //fazendo requisição para url de cursos da alura
        $resposta = $this->httpCliente->request('GET', $url);

        //da resposta, eu quero apenas o body do html
        $html = $resposta->getBody();

        //vou usar o Crawler para acessar o body do html
        $this->crawler->addHtmlContent($html);

        //buscando os elementos dos cursos de php através do seletor da classe na página da alura
        $elementosCursos =  $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }
}
