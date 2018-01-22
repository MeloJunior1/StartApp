<?php

namespace App\Utils;

use App\Contracts\ISearch;

class SearchInterator implements ISearch 
{
    /**
     * funcao retorna a chave do elemento procurado no array
     */
    public function search ($haystack, $needle, $index = NULL)
    {
        if( is_null( $haystack ) ) {
            return -1;
        }
    
        $arrayIterator = new \RecursiveArrayIterator( $haystack );
    
        $iterator = new \RecursiveIteratorIterator( $arrayIterator );
    
        while( $iterator -> valid() ) {
    
            if( ( ( isset( $index ) and ( $iterator -> key() == $index ) ) or
                ( ! isset( $index ) ) ) and ( $iterator -> current() == $needle ) ) {
    
                return $arrayIterator -> key();
            }
    
            $iterator -> next();
        }
    
        return -1;
    }
}