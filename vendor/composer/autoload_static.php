<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7899c68ae35281e7c1fcf5d62419bd7
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7899c68ae35281e7c1fcf5d62419bd7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7899c68ae35281e7c1fcf5d62419bd7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc7899c68ae35281e7c1fcf5d62419bd7::$classMap;

        }, null, ClassLoader::class);
    }
}
