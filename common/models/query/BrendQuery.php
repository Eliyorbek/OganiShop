<?php

namespace common\models\query;

use common\models\Brend;

/**
 * This is the ActiveQuery class for [[Brend]].
 *
 * @see Brend
 */
class BrendQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Brend[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Brend|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
