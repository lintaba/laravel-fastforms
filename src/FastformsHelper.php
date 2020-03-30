<?php declare(strict_types=1);


namespace Lintaba\Fastforms;


class FastformsHelper
{
    
    public static function fieldName($field){
        return preg_replace('/\.([^.]+)/','[\\1]',$field);
    }


    public static function transPrefix(array $items, string $prefix) : array
    {
        $res = [];
        foreach($items as $key=>$val){
            $res[$key] = trans($prefix.$val);
        }
        return $res;
    }
    
    
    protected $countries = [];
    
    
    public function __construct()
    {
        $this->initCountries();
    }
    
    public function countries() : array{
        return $this->countries;
    }
    
    public function addCountry(string $code,string $name) : self
    {
        $this->countries[$code] = $name;
        return $this;
    }
    
    private function initCountries()
    {
        
        $this->countries = [
            'HU'=>'HU',
        ];
    }
    
    
}
