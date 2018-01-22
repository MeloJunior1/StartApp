<?php

namespace App\Utils;

use App\Contracts\ISearch;

class LocalizationBrazilUtil {

    protected $filter;

    public function __construct($filter = null)
    {
        $this->filter = $filter;
    }

    public static function allLocalization() 
    {
        return file_get_contents(__DIR__.'\brazil.json');
    }

    public function filterEstados($estado)
    {        
        return strstr(strtolower($estado->sigla), strtolower($this->filter));
    }

    public function filterCidades($cidade)
    {
        return strstr(strtolower($cidade), strtolower($this->filter));
    }

    /**
     * esta funcao busca no .json e retorna o indice do valor achado
     * retorna -1 se nao achar
     * 
     * @param ISearch $search
     * @param array $values, 
     * @param $value, 
     * @param $index = NULL
     */
    public function find(ISearch $search, array $values, $value, $index = NULL)
    {
        return $search->search($values, $value, $index);
    }
}