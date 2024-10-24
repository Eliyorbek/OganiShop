<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/mycss.css',
        "plugins/fontawesome-free/css/all.min.css",
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
////        "plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
        "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
        "plugins/jqvmap/jqvmap.min.css",
        "dist/css/adminlte.min.css",
        "plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        "plugins/daterangepicker/daterangepicker.css",
        "plugins/summernote/summernote-bs4.min.css",
//        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
        ];

    public $js = [
        "plugins/jqery/jquery.min.js",
//            "plugins/jquery-ui/jquery-ui.min.js",
            "plugins/bootstrap/js/bootstrap.bundle.min.js",
            "dist/js/adminlte.js",
            "dist/js/demo.js",
            "dist/js/pages/dashboard.js",
//            'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js',
            'js/ajax.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
