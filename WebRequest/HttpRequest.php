<?php

namespace WebRequest;

/**
 * Classe abstrata para requisições.
 *
 * @abstract
 */
abstract class HttpRequest implements IHttpRequest
{
    use TGlobal;

    /**
     * Returna a requisição executada em formato XML.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param string $method Tipo de cabeçalho que será informado na requisição. (Padrão: GET)
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param array $header Informação de cabeçalho adicionais que serão utilizadas. (Padrão: Sem dados)
     *
     * @final
     *
     * @return \SimpleXMLElement
     */
    final public function xmlExecute($url, $method = 'GET', $data = [], $header = [])
    {
        return simplexml_load_string($this->execute($url, $method, $data, $header));
    }

    /**
     * Retorna a requisição executada em formato JSON.
     *
     * @param string $url Caminho que será realizada a requisição.
     * @param string $method Tipo de cabeçalho que será informado na requisição. (Padrão: GET)
     * @param array $data Dados que serão enviados pela requisição. (Padrão: Sem dados)
     * @param array $header Informação de cabeçalho adicionais que serão utilizadas. (Padrão: Sem dados)
     *
     * @final
     *
     * @return object
     */
    public function jsonExecute($url, $method = 'GET', $data = [], $header = [])
    {
        return json_decode($this->execute($url, $method, $data, $header));
    }
}
