<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcca5b6466f31ecd6deb2a06d9b31dd42
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcca5b6466f31ecd6deb2a06d9b31dd42::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcca5b6466f31ecd6deb2a06d9b31dd42::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcca5b6466f31ecd6deb2a06d9b31dd42::$classMap;

        }, null, ClassLoader::class);
    }
}
