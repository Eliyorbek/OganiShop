<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Ogani  SHop</title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<?php //=$this->render('_header')?>

    <?=$this->render('_header')?>

    <?=$content?>

   <?=$this->render('_footer')?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();


