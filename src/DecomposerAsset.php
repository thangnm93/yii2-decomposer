<?php
namespace thangnm93\decomposer;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\bootstrap\BootstrapAsset;

/**
 * {@inheritDoc}
 */
class DecomposerAsset extends AssetBundle {
    public $sourcePath = '@decomposer/src/assets';
    /**
     * {@inheritDoc}
     */
    public function init() {
        $this->css = [
            'css/custom.css',
        ];
        $this->js = [
            'js/decomposer.js',
            'js/jquery.dataTables.min.js',
            'js/dataTables.bootstrap.min.js',
            'js/jquery.highlight.js',
            'js/dataTables.searchHighlight.min.js',
        ];
        $this->depends = [
            JqueryAsset::class,
            BootstrapAsset::class,
        ];
    }
}