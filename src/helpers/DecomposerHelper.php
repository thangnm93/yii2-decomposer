<?php
namespace thangnm93\decomposer\helpers;

use Yii;

class DecomposerHelper
{
    /**
     * Make Decomposer name as a constant to be used
     * in resolving its version number
     */

    const PACKAGE_NAME = 'thangnm93/yii2-decomposer';

    /**
     * Initialise blank arrays for extra stats to be added
     * by app or other package devs
     */

    public static $yiiExtras = [];
    public static $serverExtras = [];
    public static $extraStats = [];
    /**
     * Get the Decomposer system report as a PHP array
     * @return array
     */

    public static function getReportArray()
    {
        $composerArray = self::getComposerArray();
        $packages = self::getPackagesAndDependencies($composerArray['require']);
        $version = self::getDecomposerVersion($composerArray, $packages);

        $reportArray['Server Environment'] = self::getServerEnv();
        $reportArray['Yii 2 Environment'] = self::getYiiEnv($version);
        $reportArray['Installed Packages'] = self::getPackagesArray($composerArray['require']);

        empty(self::getExtraStats()) ? '' : $reportArray['Extra Stats'] = self::getExtraStats();

        return $reportArray;
    }

    /**
     * Add Yii specific stats by app or any other package dev
     * @param $yiiStatsArray
     */

    public static function addYiiStats(array $yiiStatsArray)
    {
        self::$yiiExtras = array_merge(self::$yiiExtras, $yiiStatsArray);
    }

    /**
     * Add Extra stats by app or any other package dev
     * @param array $extraStatsArray
     */

    public static function addExtraStats(array $extraStatsArray)
    {
        self::$extraStats = array_merge(self::$extraStats, $extraStatsArray);
    }

    /**
     * Add Server specific stats by app or any other package dev
     * @param array $serverStatsArray
     */

    public static function addServerStats(array $serverStatsArray)
    {
        self::$serverExtras = array_merge(self::$serverExtras, $serverStatsArray);
    }

    /**
     * Get the extra stats added by the app or any other package dev
     * @return array
     */

    public static function getExtraStats()
    {
        return self::$extraStats;
    }

    /**
     * Get additional server info added by the app or any other package dev
     * @return array
     */

    public static function getServerExtras()
    {
        return self::$serverExtras;
    }

    /**
     * Get additional yii info added by the app or any other package dev
     * @return array
     */

    public static function getYiiExtras()
    {
        return self::$yiiExtras;
    }

    /**
     * Get the Decomposer system report as JSON
     * @return false|string
     */

    public static function getReportJson()
    {
        return json_encode(self::getReportArray());
    }

    /**
     * Get the Composer file contents as an array
     * @return array
     */

    public static function getComposerArray()
    {
        $baseComposerFile = dirname(Yii::getAlias('@vendor')) . DIRECTORY_SEPARATOR . 'composer.json';
        $json = file_get_contents($baseComposerFile);
        return json_decode($json, true);
    }

    /**
     * Get Installed packages & their Dependencies
     *
     * @param $packagesArray
     * @return array
     */

    public static function getPackagesAndDependencies($packagesArray)
    {
        $packages = [];
        foreach ($packagesArray as $key => $value) {
            $packageFile = Yii::getAlias('@vendor') . "/{$key}/composer.json";
            if ($key !== 'php' && file_exists($packageFile)) {
                $json2 = file_get_contents($packageFile);
                $dependenciesArray = json_decode($json2, true);
                $dependencies = array_key_exists('require', $dependenciesArray) ? $dependenciesArray['require'] : Yii::t('decomposer', 'No dependencies');
                $devDependencies = array_key_exists('require-dev', $dependenciesArray) ? $dependenciesArray['require-dev'] : Yii::t('decomposer', 'No dependencies');
                $packages[] = [
                    'name' => $key,
                    'version' => $value,
                    'dependencies' => $dependencies,
                    'dev-dependencies' => $devDependencies
                ];
            }
        }

        return $packages;
    }

    /**
     * Get Yii environment details
     *
     * @param $decomposerVersion
     * @return array
     */

    public static function getYiiEnv($decomposerVersion)
    {
        return [
            'version' => Yii::getVersion(),
            'timezone' => Yii::$app->getTimeZone(),
            'debug_mode' => YII_DEBUG,
            'decomposer_version' => $decomposerVersion,
            'app_size' => self::sizeFormat(self::folderSize(Yii::$app->basePath))
        ];
    }

    /**
     * Get PHP/Server environment details
     * @return array
     */
    public static function getServerEnv()
    {
        return array_merge([
            'version' => PHP_VERSION,
            'server_software' => $_SERVER['SERVER_SOFTWARE'],
            'server_os' => php_uname(),
            'ssl_installed' => self::checkSslIsInstalled(),
            'database_driver' => Yii::$app->db->getDriverName(),
            'cache_driver' => basename(Yii::$app->cache->className()),
            'openssl' => extension_loaded('openssl'),
            'imagick' => extension_loaded('imagick'),
            'gd' => extension_loaded('gd'),
            'pdo' => extension_loaded('pdo'),
            'intl' => extension_loaded('intl'),
            'pdo_sqlite' => extension_loaded('pdo_sqlite'),
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'pdo_pgsql' => extension_loaded('pdo_pgsql'),
            'memcache' => extension_loaded('memcache'),
            'memcached' => extension_loaded('memcached'),
            'apc' => extension_loaded('apc'),
            'dom' => extension_loaded('dom'),
            'fileinfo' => extension_loaded('fileinfo'),
            'mbstring' => extension_loaded('mbstring'),
            'tokenizer' => extension_loaded('tokenizer'),
            'safe_mode' => self::checkPhpIniOff('safe_mode'),
            'expose_php' => self::checkPhpIniOff('expose_php'),
            'allow_url_include' => self::checkPhpIniOff('allow_url_include'),
            'xml' => extension_loaded('xml')
        ], self::getServerExtras());
    }

    /**
     * Get Installed packages & their version numbers as an associative array
     *
     * @param $composerRequireArray
     * @return array
     */

    private static function getPackagesArray($composerRequireArray)
    {
        $packagesArray = self::getPackagesAndDependencies($composerRequireArray);
        $packages = array();
        foreach ($packagesArray as $packageArray) {
            $packages[$packageArray['name']] = $packageArray['version'];
        }
        return $packages;
    }

    /**
     * Get current installed Decomposer version
     *
     * @param $composerArray
     * @param $packages
     * @return string
     */

    public static function getDecomposerVersion($composerArray, $packages)
    {
        if (isset($composerArray['require'][self::PACKAGE_NAME])) {
            return $composerArray['require'][self::PACKAGE_NAME];
        }

        if (isset($composerArray['require-dev'][self::PACKAGE_NAME])) {
            return $composerArray['require-dev'][self::PACKAGE_NAME];
        }

        foreach ($packages as $package) {
            if (isset($package['dependencies'][self::PACKAGE_NAME])) {
                return $package['dependencies'][self::PACKAGE_NAME];
            }

            if (isset($package['dev-dependencies'][self::PACKAGE_NAME])) {
                return $package['dev-dependencies'][self::PACKAGE_NAME];
            }
        }

        return 'unknown';
    }

    /**
     * Check if SSL is installed or not
     * @return boolean
     */

    private static function checkSslIsInstalled()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    }

    /**
     * Get the laravel app's size
     *
     * @param $dir
     * @return int
     */

    private static function folderSize($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::folderSize($each);
        }
        return $size;
    }

    /**
     * Format the app's size in correct units
     *
     * @param $bytes
     * @return string
     */

    private static function sizeFormat($bytes)
    {
        $kb = 1024;
        $mb = $kb * 1024;
        $gb = $mb * 1024;
        $tb = $gb * 1024;

        if (($bytes >= 0) && ($bytes < $kb)) {
            return $bytes . ' B';
        }
        if (($bytes >= $kb) && ($bytes < $mb)) {
            return ceil($bytes / $kb) . ' KB';
        }
        if (($bytes >= $mb) && ($bytes < $gb)) {
            return ceil($bytes / $mb) . ' MB';
        }
        if (($bytes >= $gb) && ($bytes < $tb)) {
            return ceil($bytes / $gb) . ' GB';
        }
        if ($bytes >= $tb) {
            return ceil($bytes / $tb) . ' TB';
        }
        return $bytes . ' B';
    }

    /**
     * Checks if PHP configuration option (from php.ini) is off.
     * @param string $name configuration option name.
     * @return bool option is off.
     */
    public static function checkPhpIniOff($name)
    {
        $value = ini_get($name);
        if (empty($value)) {
            return true;
        }
        return (strtolower($value) === 'off');
    }
}