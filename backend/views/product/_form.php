<?php

use common\models\Brend;
use common\models\Category;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var common\models\Pimage $image */
/** @var yii\widgets\ActiveForm $form */

$imageArray = $model->getImageArray();
$idArray = $model->getImageId();
?>

<div class="product-form">

    <div class="card p-3">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Mahsulot nomini kiriting']) ?>

            </div>
            <div class="col-4">
                <?= $form->field($model, 'count')->input('number', [
                    'min' => 0,
                    'step' => '1',
                    'placeholder' => 'Sonini kiriting'
                ]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'price')->input('number', [
                    'min' => 0,
                    'step' => '1',
                    'placeholder' => 'Narxni kiriting'
                ]) ?>

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where(['status' => 'active'])->all(), 'id', 'name'), ['prompt' => 'Kategoriyani tanlang']) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'brend_id')->dropDownList(ArrayHelper::map(Brend::find()->where(['status' => 'active'])->all(), 'id', 'name'), ['prompt' => 'Brendni tanlang']) ?>
            </div>
        </div>
        <?= $form->field($model, 'description')->textarea(['rows' => 2, 'placeholder' => 'Mahsulotga haqida malumot yozing']) ?>
        <?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple' => true,
                'class' => 'form-control'
            ],
            'pluginOptions' => [
                'initialPreview' => $imageArray,
                'initialPreviewAsData' => true,
                'overwriteInitial' => false,
                'showUpload' => false,
                'browseOnZoneClick' => true,
                'fileActionSettings' => [
                    'showRemove' => false,
                    'showUpload' => false,
                ],
                'browseClass' => 'btn btn-success',
                'uploadClass' => 'btn btn-info',
                'removeClass' => 'btn btn-danger',
                'removeIcon' => '<i class="fas fa-trash"></i> ',
                'maxFileCount' => 10,
            ],

        ]);
        ?>
        <!--        --><?php //= $form->field($model, 'image[]')->fileInput(['multiple'=>true , 'class'=>'form-control']) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <?php
       $idArray = json_encode($idArray);
    $js = <<< JS
    var idArray = $idArray;
     $('.kv-file-remove').on('click' ,()=>{
            alert($idArray);
        })
    
    JS;
    $this->registerJs($js);
    ?>
</div>
