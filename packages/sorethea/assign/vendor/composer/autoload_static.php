<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit54ff81367afcb16b5f4bbed74dffc087
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Soret\\Assign\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Soret\\Assign\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit54ff81367afcb16b5f4bbed74dffc087::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit54ff81367afcb16b5f4bbed74dffc087::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit54ff81367afcb16b5f4bbed74dffc087::$classMap;

        }, null, ClassLoader::class);
    }
}