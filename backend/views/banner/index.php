<?php

use common\models\Banner;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\search\BrendSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index index">


 <div class="header">
     <p class="right">
         <?= Html::a(Yii::t('app', 'Create Banner'), ['create'], ['class' => 'btn btn-success']) ?>
     </p>

 </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'subtitle',
            [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function ($model) {
                    return '<img src="/frontend/web/uploads/banner_img/'.$model->image.'" width="150" height="100" />';
                    }
            ],
            [
                    'attribute' => 'category',
                    'format'=>'raw',
                    'value'=>function($model){
                    return $model->category->name;
                    }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Banner $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
