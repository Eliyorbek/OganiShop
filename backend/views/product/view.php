<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view pb-4 index">


<div class="header">
    <div class="right">
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                    'attribute' => 'image',
                    'format'=>'raw',
                    'value'=>function($model){
                        $images = '';
                        foreach ($model->pimages as $pimage) {
                            $images .= '<img src="/frontend/web/uploads/product_img/' . $pimage->path . '" style="width:100px;height:100px; margin-right: 10px;">';
                        }
                        return $images;
                    }
            ],
            'description:ntext',
            'price',
            [
                    'attribute' => 'category',
                    'format'=>'raw',
                'value' => function($model){
                return $model->category->name;
                }
            ],
            [
                'attribute' => 'category',
                'format'=>'raw',
                'value' => function($model){
                    return $model->brend->name;
                }
            ],
            'count',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
