<?php

namespace common\models\query;

use common\models\Pimage;

/**
 * This is the ActiveQuery class for [[Pimage]].
 *
 * @see Pimage
 */
class PimageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pimage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pimage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
