<?php

namespace WebRequest;

/**
 * Trait global para registro e obter o objeto globalmente.
 */
trait TGlobal
{
    /**
     * Objeto global para a classe instânciada.
     *
     * @var object
     */
    protected static $class = null;

    /**
     * Registra o objeto para a classe para ser utilizado globalmente.
     */
    protected function registerGlobal($obj)
    {
        self::$class = $obj;
    }

    /**
     * Obtém a instância global da classe a qual foi invocada.
     *
     * @throws \Exception Caso não tenha sido definido a instância global.
     *
     * @return object
     */
    public static function getInstance()
    {
        if(is_null(self::$class) === true)
        {
            throw new \Exception('Referência de objeto não encontrada.');
        }

        return self::$class;
    }
}
