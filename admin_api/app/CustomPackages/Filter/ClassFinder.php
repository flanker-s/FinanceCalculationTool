<?php


namespace App\CustomPackages\Filter;


class ClassFinder
{
//This value should be the directory that contains composer.json
    const appRoot = __DIR__ . '/../../../';

    public static function getClassesInNamespace($namespace)
    {
        $dir = self::getNamespaceDirectory($namespace);
        $classes = [];
        self::getFilesRecursive($classes, $dir, $namespace);

        $existClasses = array_filter($classes, function ($possibleClass) {
            return class_exists($possibleClass);
        });
        return array_values($existClasses);
    }

    private static function getFilesRecursive(&$classes, $dir, $namespace)
    {
        $sub_files = scandir($dir);
        foreach ($sub_files as $file) {
            if ($file[0] != '.') { //not parent directory
                $filePath = $dir . '/' . $file;
                if (is_dir($filePath)) {
                    self::getFilesRecursive($classes, $filePath, $namespace . '\\' . $file);
                } elseif (str_contains($file, '.php')) {
                    $class = str_replace('.php', '', $namespace . '\\' . $file);
                    array_push($classes, $class);
                }
            }
        }
    }

    private static function getDefinedNamespaces()
    {
        $composerJsonPath = self::appRoot . 'composer.json';
        $composerConfig = json_decode(file_get_contents($composerJsonPath));

        return (array)$composerConfig->autoload->{'psr-4'};
    }

    private static function getNamespaceDirectory($namespace)
    {
        $composerNamespaces = self::getDefinedNamespaces();

        $namespaceFragments = explode('\\', $namespace);
        $undefinedNamespaceFragments = [];

        while ($namespaceFragments) {
            $possibleNamespace = implode('\\', $namespaceFragments) . '\\';

            if (array_key_exists($possibleNamespace, $composerNamespaces)) {
                return realpath(self::appRoot . $composerNamespaces[$possibleNamespace] . implode('/', $undefinedNamespaceFragments));
            }

            array_unshift($undefinedNamespaceFragments, array_pop($namespaceFragments));
        }
        return false;
    }
}
