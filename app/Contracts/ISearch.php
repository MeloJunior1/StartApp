<?php

namespace App\Contracts;

interface ISearch 
{
    public function search ($haystack, $needle, $index = NULL);
}