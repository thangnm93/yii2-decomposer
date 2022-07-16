<?php
namespace thangnm93\decomposer\controllers;

use thangnm93\decomposer\helpers\DecomposerHelper;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller {
    /**
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                        ],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex() {
        $composerArray = DecomposerHelper::getComposerArray();
        $packages = DecomposerHelper::getPackagesAndDependencies($composerArray['require']);
        $version = DecomposerHelper::getDecomposerVersion($composerArray, $packages);
        $yiiEnv = DecomposerHelper::getYiiEnv($version);
        $serverEnv = DecomposerHelper::getServerEnv();
        $serverExtras = DecomposerHelper::getServerExtras();
        $extraStats = DecomposerHelper::getExtraStats();
        $title = \Yii::t('decomposer', 'Yii 2 Decomposer');
        return $this->render('index', compact('title', 'packages', 'yiiEnv', 'serverEnv', 'serverExtras', 'extraStats'));
    }
}