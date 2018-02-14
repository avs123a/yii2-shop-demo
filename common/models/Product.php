<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $quantity
 *
 * @property OrderItem[] $orderItems
 * @property Brand $brand
 * @property Category $category
 * @property ProductImage[] $productImages
 */
class Product extends \yii\db\ActiveRecord implements CartPositionInterface
{
	use CartPositionTrait;
	
	
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
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id', 'quantity'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 30],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price ($)',
            'quantity' => 'Quantity',
			'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	
	//shopping cart interface functions
	public function getPrice()
    {
		if(Yii::$app->user->isGuest){
		    return $this->price;
		}else{
			return $this->price*0.8;
		}
	}
	
	public function getId()
    {
        return $this->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }
	
	public static function getProductImagesById($id)
	{
	    return ProductImage::find()->where(['product_id' => $id])->asArray()->all();
	}
}
