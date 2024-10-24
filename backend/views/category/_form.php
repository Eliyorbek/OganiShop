<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

   <div class="card p-3">
       <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

       <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
       <?php
       if (file_exists(Yii::getAlias('@frontend/web/uploads/cat_img/' . $model->image)) &&  $model->image != null) {
           ?>
           <img src="/frontend/web/uploads/cat_img/<?=$model->image?>" style="width:150px;height:150px;" alt="">
           <?php
       }
       ?>
       <?= $form->field($model, 'image')->fileInput(['class'=>'form-control']) ?>
       <?=$this->render('../activeBtn' , ['model' => $model])?>
       <div class="form-group">
           <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
       </div>

       <?php ActiveForm::end(); ?>
   </div>

</div>
