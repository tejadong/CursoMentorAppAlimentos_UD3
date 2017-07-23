<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Services;

class WikiService {
    private $wikiBaseURL;
    private $wikiWebPageCode;

    public function __construct($wikiBaseURL) {
        $this->wikiBaseURL = $wikiBaseURL;
    }

    public function getWikiBaseURL() {
        return $this->wikiBaseURL;
    }

    public function peticionCURL($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'MyBot/1.0 (http://www.mysite.com/)');

        $resultado['peticion'] = curl_exec($ch);
        $resultado['http_status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $resultado['error'] = curl_error($ch);

        curl_close($ch);

        return $resultado;
    }

    public function cargarPaginaWiki($alimento) {

        $url = $this->wikiBaseURL . $alimento;

        $peticionPagWiki = $this->peticionCURL($url);

        if (!empty($peticionPagWiki['error']) || ($peticionPagWiki['http_status'] != '304' && $peticionPagWiki['http_status'] != '200')) {
            return $peticionPagWiki['error'];
        } else {
            $peticionPagWiki = (array) json_decode($peticionPagWiki['peticion']);
            $peticionPagWiki = (array) $peticionPagWiki['query'];
            $peticionPagWiki = array_values((array) $peticionPagWiki['pages']);
            $peticionPagWiki = $peticionPagWiki[0];
            $peticionPagWiki->revisions = array_values((array)$peticionPagWiki->revisions[0]);

            $urlParseador = 'https://es.wikipedia.org/w/api.php?action=parse&format=json&contentmodel=' . $peticionPagWiki->revisions[1] .'&text=' . urlencode($peticionPagWiki->revisions[2]);
            $peticionParseadaWiki = $this->peticionCURL($urlParseador);
            $peticionParseadaWiki['peticion'] = (array) json_decode($peticionParseadaWiki['peticion']);
            $peticionParseadaWiki['peticion'] = (array) $peticionParseadaWiki['peticion']['parse'];
            $peticionParseadaWiki['peticion']['text'] = array_values((array) $peticionParseadaWiki['peticion']['text']);
            $peticionParseadaWiki['peticion']['text'] =$peticionParseadaWiki['peticion']['text'][0];

            return $peticionParseadaWiki;
        }
    }

    public function getPaginaWiki() {
        return $this->wikiWebPageCode;
    }

}