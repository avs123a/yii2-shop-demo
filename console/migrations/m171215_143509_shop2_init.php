<?php

use yii\db\Schema;
use yii\db\Migration;

class m171215_143509_shop2_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

		//category table
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(30) NOT NULL',
            'descrition' => Schema::TYPE_TEXT,
			'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-category-parent_id-category-id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');

		//brand table
		$this->createTable('{{%brand}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(30) NOT NULL',
            'descrition' => Schema::TYPE_TEXT,
			'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);
		
		
		//product table
        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
			'category_id' => Schema::TYPE_INTEGER,
			'brand_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(30) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'price' => Schema::TYPE_MONEY,
			'quantity' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
			'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-product-category_id-category_id', '{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk-product-brand_id-brand_id', '{{%product}}', 'brand_id', '{{%brand}}', 'id', 'RESTRICT');
		
		
		//product_image table
		 $this->createTable('{{%product_image}}', [
            'id' => Schema::TYPE_PK,
			'product_id' => Schema::TYPE_INTEGER,
			'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);
		
		$this->addForeignKey('fk-product_image-product_id-product-id', '{{%product_image}}', 'product_id', '{{%product}}', 'id', 'RESTRICT');
		
		//order table
        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
			'customer_type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
			'surname' => Schema::TYPE_STRING,
			'name' => Schema::TYPE_STRING,
			'country' => Schema::TYPE_STRING,
			'region' => Schema::TYPE_STRING,
			'city' => Schema::TYPE_STRING,
			'address' => Schema::TYPE_TEXT,
			'zip_code' => Schema::TYPE_STRING,
            'phone' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

		//order_item table
        $this->createTable('{{%order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'product_id' => Schema::TYPE_INTEGER,
			'price' => Schema::TYPE_MONEY,
			'color' => Schema::TYPE_STRING . '(16)',
            'quantity' => Schema::TYPE_INTEGER,
			'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);
		
		$this->addForeignKey('fk-order_item-order_id-order-id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-order_item-product_id-product-id', '{{%order_item}}', 'product_id', '{{%product}}', 'id', 'SET NULL');
		
		
		
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%product_image}}');
        $this->dropTable('{{%product}}');
		$this->dropTable('{{%brand}}');
        $this->dropTable('{{%category}}');
    }
}