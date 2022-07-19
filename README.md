<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Decomposer Extension for Yii 2</h1>
    <br>
</p>

For license information check the [LICENSE](LICENSE.txt)-file.

<p align="center">
<a href="https://packagist.org/packages/thangnm93/yii2-decomposer"><img src="https://poser.pugx.org/thangnm93/yii2-decomposer/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/thangnm93/yii2-decomposer"><img src="https://poser.pugx.org/thangnm93/yii2-decomposer/downloads" alt="Total Downloads"></a>
<a href="https://github.com/thangnm93/yii2-decomposer/blob/master/LICENSE.txt"><img src="https://poser.pugx.org/thangnm93/yii2-decomposer/license" alt="License"></a>
<a href="https://github.com/thangnm93/yii2-decomposer/blob/master/contributing.md"><img src="https://img.shields.io/badge/PRs-welcome-brightgreen.svg" alt="PRs"></a>
</p>

## Introduction

----

Yii 2 Decomposer decomposes and lists all the installed packages and their dependencies along with the Yii 2 Framework & the Server environment details your app is running in. All these just on the hit of a single route at `your-domain/decomposer`.

The demo of this extension is available at [HERE](screenshots/decomposer.png)

This extension base on [lubusIN/laravel-decomposer](https://github.com/lubusIN/laravel-decomposer) wrapper for Laravel user component.

## Requirements

----

* [PHP >= 7.2](http://php.net)
* [yiisoft/yii2 >= 2.0.13](https://github.com/yiisoft/yii2)

## Installation

----

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require thangnm93/yii2-decomposer
```

or add

```
"thangnm93/yii2-decomposer": "*"
```

to the require section of your `composer.json` file.


## Usage

----

Once the extension is installed, simply modify your application configuration as follows:

```php
return [
    'bootstrap' => ['decomposer'],
    'modules' => [
        'decomposer' => [
            'class' => 'thangnm93\decomposer\Module',
        ],
        // ...
    ],
    ...
];
```

Config `common/config/main.php` to use `Yii::$app->decompose`

  ```php
  return [
      'components' => [
          'decompose' => [
              'class' => 'thangnm93\decomposer\Decomposer',
          ],
      ],
      ...
  ];
  ```

Get Report as an Array

- You might want to access the Decomposer Report in your code so that it could be passed to any third party services like Bugsnag, etc. or maybe you want to log it yourself somewhere if required.
- The `getReportArray()` helper method has been introduced to solve the same requirement.
- First use the Decomposer class at the top as follows:
    
    ```php
  use thangnm93\decomposer\helpers\DecomposerHelper;
    ```
- Then use the `getReportArray()` helper method as follows:
  
  ```php
  $decomposerStats = DecomposerHelper::getReportArray();
  ```
- It returns a multi-dimensional associative array with 4 keys: Server Environment, Yii 2 Environment & Installed Packages & Extra stats(If you or a package in your app have added any) having the respective details as an associative array.

Get Report as JSON

- You might want to access the same Decomposer Report as JSON
- The `getReportJson()` helper method has been introduced to solve the same requirement.
- First use the Decomposer class at the top as follows:

    ```php
  use thangnm93\decomposer\helpers\DecomposerHelper;
    ```
- Then use the `getReportJson()` helper method as follows:

  ```php
  $decomposerStats = DecomposerHelper::getReportJson();
  ```
- It returns the report as JSON

## Testing

```bash
$ ./vendor/bin/phpunit --testdox --coverage-text --coverage-clover=coverage.clover
```

## Contributing

----

Thank you for considering contributing to the Yii 2 Decomposer. You can read the contribution guide lines [here](contributing.md)

## Security

----

If you discover any security related issues, please email to [contact@thangnm.info](mailto:contact@thangnm.info).

## Credits

----

- [Thang Nguyen](https://github.com/thangnm93)
