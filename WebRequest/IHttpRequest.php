<?php

namespace WebRequest;

/**
 * Interface para as requisições web.
 */
interface IHttpRequest
{
    /**
     * Executa uma requisição http com as opções de parametro informadas.
     * 
     * @param string $url Caminho que será realizada a requisição.
     * @param string $method Tipo de cabeçalho que será informado na requisição. (Padrão: GET)
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param array $header Informação de cabeçalho adicionais que serão utilizadas. (Padrão: Sem dados)
     *
     * @return string Retorno em formato string da requisição.
     */
    public function execute($url, $method = 'GET', $data = [], $header = []);
}
