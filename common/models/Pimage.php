<?php

namespace common\models;

use common\models\query\PimageQuery;
use Yii;

/**
 * This is the model class for table "pimage".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $path
 *
 * @property Product $product
 */
class Pimage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'path' => Yii::t('app', 'Path'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return PimageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PimageQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {

        return '/frontend/web/uploads/product_img/' . $this->path;
    }
}
