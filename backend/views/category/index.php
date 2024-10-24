<?php

use common\models\Category;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\search\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="category-index index">
<div class="header">
    <div class="left">
        <?php
        $this->title = 'Categories';
        $this->params['breadcrumbs'][] = $this->title;
        ?>
    </div>
    <div class="right">
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
</div>


<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return '<img src="/frontend/web/uploads/cat_img/' . $model->image . '" width="100" height="100">';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (Category $model) {
                    $btnClass = $model->status == 'active' ? 'success' : 'warning';
                    return '<a href="' . Url::to(['category/change-status', 'id' => $model->id]) . '" class="btn btn-sm  btn-' . $btnClass . '">' . $model->status . '</a>';
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
