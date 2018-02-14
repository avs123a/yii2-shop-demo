<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $title
 * @property string $descrition
 * @property string $logo_link
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
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
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 30],
            [['descrition',], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'descrition' => 'Description',
			'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }
	
	public function getLogoPath()
	{
		return Yii::getAlias('@frontend/web/images/brands/' . md5($this->id . $this->title). '.jpg');
	}
	
	public function getLogoUrl()
	{
		return Yii::getAlias('@frontendWebroot/images/brands/' . md5($this->id . $this->title). '.jpg');
	}
	
	public function afterDelete()
	{
		unlink($this->getLogoPath());
		parent::afterDelete();
	}
}
