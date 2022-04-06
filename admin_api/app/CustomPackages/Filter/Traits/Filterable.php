<?php


namespace App\CustomPackages\Filter\Traits;


use App\CustomPackages\Filter\ClassFinder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Filterable
{
    private static $filtersNamespace = 'App\\Http\\Filters\\Api\\V1\\Defaults';

    public function scopeFilter($query, $parameters)
    {
        $modelClass = get_class($this);
        $filterClass = self::getAssociatedFilterClass($modelClass);
        $query = self::applyFilters($query, $filterClass, $parameters);
        return $query;
    }

    private static function getAssociatedFilterClass(string $modelClass)
    {
        $modelName = Str::afterLast($modelClass, '\\');

        $filterClasses = ClassFinder::getClassesInNamespace(self::$filtersNamespace);
        foreach ($filterClasses as $filterClass) {
            if (self::getClassKeyWord($filterClass) === $modelName) {
                return $filterClass;
            }
        }
        return null;
    }

    private static function getClassKeyWord(string $class)
    {
        $className = Str::afterLast($class, '\\');
        return Str::before($className, 'Filter');
    }

    private static function getFilterMethods(string $filterClass)
    {
        $reflection = new \ReflectionClass($filterClass);
        $methods = $reflection->getMethods();
        $filterMethods = [];

        foreach ($methods as $method) {
            $name = Str::after($method->name, 'filter');
            if ($name) {
                $filterMethods[self::toModelNotation($name)] = $method;
            }
        }
        return $filterMethods;
    }

    private static function applyFilters(Builder $query, string $filterClass, array $parameters)
    {
        $filterMethods = self::getFilterMethods($filterClass);
        foreach ($parameters as $name => $parameter) {
            if(isset($filterMethods[$name])){
                $filterMethods[$name]->invoke(new $filterClass(), $query, $parameter);
            }
        }
        return $query;
    }

    private static function toModelNotation(string $name){
        return Str::snake($name);
    }
}
