<?php

namespace common\models;

use common\models\query\PimageQuery;
use common\models\query\ProductQuery;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property int|null $category_id
 * @property int|null $brend_id
 * @property int|null $count
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Brend $brend
 * @property Category $category
 * @property Pimage[] $pimages
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public $image;

    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price', 'category_id', 'brend_id', 'count', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg,jpeg,webp'],
            [['brend_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brend::class, 'targetAttribute' => ['brend_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'category_id' => Yii::t('app', 'Category ID'),
            'brend_id' => Yii::t('app', 'Brend ID'),
            'count' => Yii::t('app', 'Count'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Brend]].
     *
     * @return \yii\db\ActiveQuery|BrendQuery
     */
    public function getBrend()
    {
        return $this->hasOne(Brend::class, ['id' => 'brend_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Pimages]].
     *
     * @return \yii\db\ActiveQuery|PimageQuery
     */
    public function getPimages()
    {
        return $this->hasMany(Pimage::class, ['product_id' => 'id']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name', 'category_id', 'brend_id', 'count', 'price', 'image'];
        $scenarios['update'] = ['name', 'category_id', 'brend_id', 'count', 'price'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function getImageArray()
    {
        $arr = [];

        foreach ($this->pimages as $pimage) {
            $arr[] = $pimage->getImageUrl();
        }

        return $arr;
    }

    public function getImageId(): array
    {
        $arr = [];
        foreach ($this->pimages as $pimage) {
        $arr[] = $pimage->id;
        }
        return $arr;
    }
}
