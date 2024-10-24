<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use yii\data\Pagination;
use yii\web\Controller;

class ShopController extends MyController
{

    public function actionIndex(){
        $products = Product::find()->all();
        $categories = Category::find()->where(['status'=>'active'])->all();
        return $this->render('index' , compact('products' , 'categories'));

    }

}