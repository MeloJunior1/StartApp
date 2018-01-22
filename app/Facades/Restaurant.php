<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * Description of Ajax Facade Accessor
 *
 * @author Administrator
 */
class Restaurant extends Facade{
    //put your code here
    protected static function getFacadeAccessor() { return 'restaurant'; }
}
