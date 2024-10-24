<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Brend $model */

$this->title = 'Create Brend';
$this->params['breadcrumbs'][] = ['label' => 'Brends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brend-create">

  <div class="card p-4">
      <h4><?= Html::encode($this->title) ?></h4>

      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
  </div>

</div>
