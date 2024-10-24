<?php

use common\models\Brend;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BrendSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Brends';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brend-index index">

   <div class="header">
       <p class="right">
           <?= Html::a('Create Brend', ['create'], ['class' => 'btn btn-success']) ?>
       </p>
   </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (Brend $model) {
                    $btnClass = $model->status == 'active' ? 'success' : 'warning';
                    return '<a href="' . Url::to(['brend/change-status', 'id' => $model->id]) . '" class="btn btn-sm  btn-' . $btnClass . '">' . $model->status . '</a>';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Brend $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
