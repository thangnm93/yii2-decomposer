<?php
namespace thangnm93\decomposer;

use thangnm93\decomposer\helpers\DecomposerHelper;
use yii\base\Component;

class Decomposer extends Component {
    /**
     * Add Yii specific stats by app or any other package dev
     * @param array $yiiStatsArray
     */
    public function addYiiStats(array $yiiStatsArray)
    {
        DecomposerHelper::addYiiStats($yiiStatsArray);
    }

    /**
     * Add Extra stats by app or any other package dev
     * @param array $extraStatsArray
     */
    public function addExtraStats(array $extraStatsArray)
    {
        DecomposerHelper::addExtraStats($extraStatsArray);
    }

    /**
     * Add Server specific stats by app or any other package dev
     * @param array $serverStatsArray
     */

    public static function addServerStats(array $serverStatsArray)
    {
        DecomposerHelper::addServerStats($serverStatsArray);
    }

    /**
     * Get the extra stats added by the app or any other package dev
     * @return array
     */

    public static function getExtraStats()
    {
        return DecomposerHelper::getExtraStats();
    }

    /**
     * Get Yii environment details
     *
     * @param $decomposerVersion
     * @return array
     */
    public static function getYiiEnv($decomposerVersion)
    {
        return DecomposerHelper::getYiiEnv($decomposerVersion);
    }

    /**
     * Get additional server info added by the app or any other package dev
     * @return array
     */

    public static function getServerExtras()
    {
        return DecomposerHelper::getServerExtras();
    }

    /**
     * Get additional yii info added by the app or any other package dev
     * @return array
     */
    public static function getYiiExtras()
    {
        return DecomposerHelper::getYiiExtras();
    }

    /**
     * Get the Decomposer system report as JSON
     * @return false|string
     */

    public static function getReportJson()
    {
        return DecomposerHelper::getReportJson();
    }

    /**
     * Get the Composer file contents as an array
     * @return array
     */
    public static function getComposerArray()
    {
        return DecomposerHelper::getComposerArray();
    }

    /**
     * Get Installed packages & their Dependencies
     *
     * @param $packagesArray
     * @return array
     */
    public static function getPackagesAndDependencies($packagesArray)
    {
        return DecomposerHelper::getPackagesAndDependencies($packagesArray);
    }

    /**
     * Get PHP/Server environment details
     * @return array
     */
    public static function getServerEnv()
    {
        return DecomposerHelper::getServerEnv();
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
        return DecomposerHelper::getDecomposerVersion($composerArray, $packages);
    }
}