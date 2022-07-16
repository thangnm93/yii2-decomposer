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
}