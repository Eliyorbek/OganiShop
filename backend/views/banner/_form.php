<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Banner $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="banner-form p-3">

   <div class="card p-3">
       <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

       <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'subtitle')->textarea() ?>

       <?php if($model->image != null):?>
       <?php if(Yii::getAlias('@frontend/web/uploads/banner_img/'.$model->image) != null):?>
           <img src="/frontend/web/uploads/banner_img/<?=$model->image?>"  style="width:150px; height:100px;" alt="">
       <?php endif;?>
       <?php endif;?>
       <?= $form->field($model, 'image')->fileInput(['class'=>'form-control']) ?>

       <?= $form->field($model, 'category_id')->dropDownList(
               \yii\helpers\ArrayHelper::map(\common\models\Category::find()->all() , 'id' , 'name'), ['prompt'=>'Tanlang']) ?>

       <div class="form-group">
           <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
       </div>

       <?php ActiveForm::end(); ?>
   </div>

</div>
