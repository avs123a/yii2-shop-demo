<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_image".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $imgpath
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
			'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	
	public function getProductImgPath()
	{
		return Yii::getAlias('@frontend/web/images/products/' . md5($this->id . $this->product_id). '.jpg');
	}
	
	public static function getProductImgUrl($id, $prid)
	{
		return Yii::getAlias('@frontendWebroot/images/products/' . md5($id . $prid). '.jpg');
	}
	
	public function afterDelete()
	{
		unlink($this->getProductImgPath());
		parent::afterDelete();
	}
}
