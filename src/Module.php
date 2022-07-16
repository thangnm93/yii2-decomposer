<?php
namespace thangnm93\decomposer;

use Yii;
use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'thangnm93\decomposer\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        $configUrlRule = [
            'prefix'      => 'decomposer',
            'routePrefix' => 'decomposer',
            'rules'       => [
                '/' => 'default/index',
                '<action:\w+>' => 'default/<action>',
            ],
        ];
        $configUrlRule['class'] = 'yii\web\GroupUrlRule';
        $rule = Yii::createObject($configUrlRule);
        $app->urlManager->addRules([$rule], false);
        if (!isset($app->get('i18n')->translations['decomposer*'])) {
            $app->get('i18n')->translations['decomposer*'] = [
                'class'          => PhpMessageSource::class,
                'basePath'       => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US',
            ];
        }
        Yii::setAlias('@decomposer', dirname(__DIR__));
    }
}