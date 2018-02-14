<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $customer_type
 * @property string $surname
 * @property string $name
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $email
 * @property string $notes
 * @property string $status
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
	//order status
	const STATUS_NEW = 0;
	const STATUS_PAID = 1;
	const STATUS_SHIPPING = 2;
	const STATUS_DONE = 3;
	const STATUS_CANCELLED = 5;
	
	//customer type
	const GUEST = 0;
	const USER = 1;
	
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
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_NEW],
			['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_PAID, self::STATUS_SHIPPING, self::STATUS_DONE, self::STATUS_CANCELLED]],
            [['address', 'notes'], 'string'],
            ['customer_type', 'default', 'value' => self::GUEST],
			['customer_type', 'in', 'range' => [self::GUEST, self::USER]],
            [['surname', 'name', 'country', 'region', 'city', 'zip_code', 'phone', 'email', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'customer_type' => 'Customer Type',
            'surname' => 'Surname',
            'name' => 'Name',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'address' => 'Address',
            'zip_code' => 'Zip Code',
            'phone' => 'Phone',
            'email' => 'Email',
            'notes' => 'Notes',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }
}
