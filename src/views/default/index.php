<?php
use thangnm93\decomposer\DecomposerAsset;
DecomposerAsset::register($this);
$this->title = $title;
?>
<div class="decomposer">
    <div class="row">
        <div class="col-sm-12">
            <div class="bs-callout bs-callout-primary">
                <p><?= Yii::t('decomposer', 'Please share this information for troubleshooting') ?>:</p>
                <button id="btn-report" class="btn btn-info btn-sm"><?= Yii::t('decomposer', 'Get System Report') ?></button>
                <div id="report-wrapper">
                    <textarea name="txt-report" id="txt-report" class="col-sm-12" rows="10" spellcheck="false" onfocus="this.select()">
                        ### <?= Yii::t('decomposer', 'Yii 2 Environment') ?>

                        - <?= Yii::t('decomposer', 'Yii Version') ?>: <?php echo $yiiEnv['version'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Timezone') ?>: <?php echo $yiiEnv['timezone'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Debug Mode') ?>: <?php echo ($yiiEnv['debug_mode'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Decomposer Version') ?>: <?php echo $yiiEnv['decomposer_version'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'App Size') ?>: <?php echo $yiiEnv['app_size'] . "\n" ?>

                        ### <?= Yii::t('decomposer', 'Server Environment') ?>

                        - <?= Yii::t('decomposer', 'PHP Version') ?>: <?php echo $serverEnv['version'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Server Software') ?>: <?php echo $serverEnv['server_software'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Server OS') ?>: <?php echo $serverEnv['server_os'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Database Driver') ?>: <?php echo $serverEnv['database_driver'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'Cache Driver') ?>: <?php echo $serverEnv['cache_driver'] . "\n" ?>
                        - <?= Yii::t('decomposer', 'SSL Installed') ?>: <?php echo $serverEnv['ssl_installed'] ? '&#10004;' : '&#10008;' . "\n" ?>
                        - <?= Yii::t('decomposer', 'ImageMagick PHP Ext') ?>: <?php echo $serverEnv['imagick'] ? '&#10004;' : '&#10008;' . "\n" ?>
                        - <?= Yii::t('decomposer', 'GD Ext') ?>: <?php echo ($serverEnv['gd'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Memcache Ext') ?>: <?php echo (($serverEnv['memcache'] || $serverEnv['memcached']) ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'APC Ext') ?>: <?php echo ($serverEnv['apc'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Intl Ext') ?>: <?php echo ($serverEnv['intl'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Openssl Ext') ?>: <?php echo ($serverEnv['openssl'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'PDO Ext') ?>: <?php echo ($serverEnv['pdo'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'PDO SQLite Ext') ?>: <?php echo ($serverEnv['pdo_sqlite'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'PDO MySQL Ext') ?>: <?php echo ($serverEnv['pdo_mysql'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'PDO PostgreSQL Ext') ?>: <?php echo ($serverEnv['pdo_pgsql'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'MBString Ext') ?>: <?php echo ($serverEnv['mbstring'] ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Tokenizer Ext') ?>: <?php echo ($serverEnv['tokenizer']  ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'Fileinfo Ext') ?>: <?php echo ($serverEnv['fileinfo']  ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'DOM Ext') ?>: <?php echo ($serverEnv['dom']  ? '&#10004;' : '&#10008;') . "\n" ?>
                        - <?= Yii::t('decomposer', 'XML Ext') ?>: <?php echo ($serverEnv['xml'] ? '&#10004;' : '&#10008;')  . "\n" ?>
                        <?php if(!empty($serverExtras)) { ?>
                            <?php foreach($serverExtras as $extraStatKey => $extraStatValue) { ?>
                                - <?php echo $extraStatKey ?>: <?php echo is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') . "\n" : $extraStatValue . "\n" ?>
                            <?php } ?>
                        <?php } ?>

                        <?php if(!empty($packages)) { ?>
                        ### <?= Yii::t('decomposer', 'Installed Packages & their version numbers') ?>

                        <?php foreach($packages as $package) { ?>
                        - <?php echo $package['name'] ?> : <?php echo $package['version']. "\n" ?>
                        <?php } ?>
                        <?php } ?>

                        <?php if(!empty($extraStats)) { ?>

                        ### <?= Yii::t('decomposer', 'Extra Information') ?>
                        <?php foreach($extraStats as $extraStatKey => $extraStatValue) { ?>
                        - <?php echo $extraStatKey ?> : <?php echo is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') . "\n" : $extraStatValue . "\n" ?>
                        <?php } ?>
                        <?php } ?>
                    </textarea>
                    <button id="copy-report" class="btn btn-info btn-sm"><?= Yii::t('decomposer', 'Copy Report') ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('decomposer', 'Installed Packages & their version numbers') ?></h3>
                </div>
                <div class="panel-body">
                    <table id="decomposer" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th><?= Yii::t('decomposer', 'Package Name') ?> : <?= Yii::t('decomposer', 'Version') ?></th>
                            <th><?= Yii::t('decomposer', 'Dependency Name') ?> : <?= Yii::t('decomposer', 'Version') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($packages as $package) { ?>
                        <tr>
                            <td><?php echo $package['name'] ?> : <span class="label ld-version-tag"><?php echo $package['version'] ?></span></td>
                            <td>
                                <ul>
                                    <?php if(is_array($package['dependencies'])) { ?>
                                    <?php foreach($package['dependencies'] as $dependencyName => $dependencyVersion) { ?>
                                    <li><?php echo $dependencyName ?> : <span class="label ld-version-tag"><?php echo $dependencyVersion ?></span></li>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <li><span class="label label-primary"><?php echo $package['dependencies'] ?></span></li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('decomposer', 'Yii 2 Environment') ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Yii Version') ?>: <?php echo $yiiEnv['version'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Timezone') ?>: <?php echo $yiiEnv['timezone'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Debug Mode') ?>: <?php echo $yiiEnv['debug_mode'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Decomposer Version') ?>: <?php echo $yiiEnv['decomposer_version'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'App Size') ?>: <?php echo $yiiEnv['app_size'] ?></li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('decomposer', 'Server Environment') ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item"><?= Yii::t('decomposer', 'PHP Version') ?>: <?php echo $serverEnv['version'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Server Software') ?>: <?php echo $serverEnv['server_software'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Server OS') ?>: <?php echo $serverEnv['server_os'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Database Driver') ?>: <?php echo $serverEnv['database_driver'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Cache Driver') ?>: <?php echo $serverEnv['cache_driver'] ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'SSL Installed') ?>: <?php echo $serverEnv['ssl_installed'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'ImageMagick PHP Ext') ?>: <?php echo $serverEnv['imagick'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'GD Ext') ?>: <?php echo $serverEnv['gd'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Memcache Ext') ?>: <?php echo ($serverEnv['memcache'] || $serverEnv['memcached']) ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'APC Ext') ?>: <?php echo $serverEnv['apc'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Intl Ext') ?>: <?php echo $serverEnv['intl'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Openssl Ext') ?>: <?php echo $serverEnv['openssl'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'PDO Ext') ?>: <?php echo $serverEnv['pdo'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'PDO SQLite Ext') ?>: <?php echo $serverEnv['pdo_sqlite'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'PDO MySQL Ext') ?>: <?php echo $serverEnv['pdo_mysql'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'PDO PostgreSQL Ext') ?>: <?php echo $serverEnv['pdo_pgsql'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'MBString Ext') ?>: <?php echo $serverEnv['mbstring'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Tokenizer Ext') ?>: <?php echo $serverEnv['tokenizer']  ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>'?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'Fileinfo Ext') ?>: <?php echo $serverEnv['fileinfo']  ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>'?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'DOM Ext') ?>: <?php echo $serverEnv['dom']  ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>'?></li>
                        <li class="list-group-item"><?= Yii::t('decomposer', 'XML Ext') ?>: <?php echo $serverEnv['xml'] ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>' ?></li>

                        <?php if(!empty($serverExtras)) { ?>
                            <?php foreach($serverExtras as $extraStatKey => $extraStatValue) { ?>
                            <li class="list-group-item"><?php echo $extraStatKey ?>: <?php echo is_bool($extraStatValue) ? ($extraStatValue ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>') : $extraStatValue ?></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <?php if(!empty($extraStats)) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('decomposer', 'Extra Stats') ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <?php foreach($extraStats as $extraStatKey => $extraStatValue) { ?>
                        <li class="list-group-item"><?php echo $extraStatKey ?>: <?php echo is_bool($extraStatValue) ? ($extraStatValue ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>') : $extraStatValue ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    var DecomposerConfigs = {
        "search": '<?= Yii::t('decomposer', "Search") ?>',
        "lengthMenu": '<?= Yii::t('decomposer', "Display _MENU_ records per page") ?>',
        "zeroRecords": '<?= Yii::t('decomposer', "No matching records found") ?>',
        "info": '<?= Yii::t('decomposer', "Showing _START_ to _END_ of _TOTAL_ entries") ?>',
        "infoEmpty": '<?= Yii::t('decomposer', "No records available") ?>',
        "infoFiltered": '<?= Yii::t('decomposer', "(filtered from _MAX_ total records)") ?>',
        "paginate": {
            "first": '<?= Yii::t('decomposer', "First") ?>',
            "last": '<?= Yii::t('decomposer', "Last") ?>',
            "next": '<?= Yii::t('decomposer', "Next") ?>',
            "previous": '<?= Yii::t('decomposer', "Previous") ?>'
        }
    }
</script>
