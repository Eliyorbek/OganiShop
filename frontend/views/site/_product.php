<?php

/* @var $this \yii\web\View */

use common\models\Category;
use common\models\Product;
use yii\helpers\Url;

$products = Product::find()->all();
$categories = Category::find()->where(['status'=>'active'])->all();
?>

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
<!---->
                       <?php if ($categories!=null):?>
                       <?php foreach ($categories as $category):?>
                               <li data-filter=".<?$category->name?>"><?=$category->name?></li>
                       <?php endforeach;?>
                       <?php endif;?>


                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php if($products != null):?>
            <?php foreach ($products as $product):?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="/uploads/product_img/<?=$product->pimages[0]['path']?>">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="<?=Url::to(['shop/index'])?>"><?=$product->name?></a></h6>
                        <h5><?=$product->price?> so'm</h5>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>

        </div>
    </div>
</section>
<!-- Featured Section End -->
