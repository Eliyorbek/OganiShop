<?php
use common\models\Category;
use yii\helpers\Url;
$categories = Category::find()->where(['status'=>'active'])->all();
?>
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php if($categories != null):?>
                <?php foreach($categories as $category):?>
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="/uploads/cat_img/<?=$category->image?>">
                                <h5><a href="<?=Url::to(['shop/index'])?>"><?=$category->name?></a></h5>
                            </div>
                        </div>
                <?php endforeach;?>
                <?php endif;?>

            </div>
        </div>
    </div>
</section>