<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbcde13ed977a4962a78ebee82660d34f
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'A' => 
        array (
            'Authorizator\\classes\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'Authorizator\\classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbcde13ed977a4962a78ebee82660d34f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbcde13ed977a4962a78ebee82660d34f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbcde13ed977a4962a78ebee82660d34f::$classMap;

        }, null, ClassLoader::class);
    }
}
