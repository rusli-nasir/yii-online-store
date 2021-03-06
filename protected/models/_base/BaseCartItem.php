<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{cart_item}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "CartItem".
 *
 * Columns in table "{{cart_item}}" available as properties of the model,
 * followed by relations of table "{{cart_item}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property double $amount
 * @property integer $size_id
 * @property integer $color_id
 * @property integer $state_id
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property Product $product
 */
abstract class BaseCartItem extends ActiveRecord {
	const QUANTITY = 1;
	public static function getStatusOptions($id = null) {
		$list = array (
				"Draft",
				"Published",
				"Archive" 
		);
		if ($id == null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id];
		return $id;
	}
	public static function getTypeOptions($id = null) {
		$list = array (
				"TYPE1",
				"TYPE2",
				"TYPE3" 
		);
		if ($id == null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id];
		return $id;
	}
	public function beforeValidate() {
		if ($this->isNewRecord) {
			if (! isset ( $this->create_user_id ))
				$this->create_user_id = Yii::app ()->user->id;
			if (! isset ( $this->create_time ))
				$this->create_time = new CDbExpression ( 'NOW()' );
		} else {
		}
		return parent::beforeValidate ();
	}
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return '{{cart_item}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', 'CartItem|CartItems', $n );
	}
	public static function representingColumn() {
		return 'create_time';
	}
	public function rules() {
		return array (
				array (
						'cart_id, product_id,create_time',
						'required' 
				),
				array (
						'cart_id, product_id,quantity, color_id, state_id, type_id, create_user_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'amount',
						'numerical' 
				),
				array (
						'update_time',
						'safe' 
				),
				array (
						'amount, size_id, color_id, state_id, type_id, create_user_id, update_time',
						'default',
						'setOnEmpty' => true,
						'value' => null 
				),
				array (
						'id, cart_id, product_id, amount, size_id, color_id, state_id, type_id, create_user_id, create_time, update_time',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	public function relations() {
		return array (
				'product' => array (
						self::BELONGS_TO,
						'Product',
						'product_id' 
				),
				'cart' => array (
						self::BELONGS_TO,
						'Cart',
						'cart_id' 
				),
				'color' => array (
						self::BELONGS_TO,
						'Color',
						'color_id'
				), // get related product color if any.
				'size' => array (
						self::BELONGS_TO,
						'Size',
						'size_id'
				),
		);
	}
	public function pivotModels() {
		return array ();
	}
	public function attributeLabels() {
		return array (
				'id' => Yii::t ( 'app', 'ID' ),
				'cart_id' => Yii::t ( 'app', 'cart' ),
				'product_id' => Yii::t ( 'app', 'item' ),
				'amount' => Yii::t ( 'app', 'amout' ),
				'size_id' => Yii::t ( 'app', 'size' ),
				'color_id' => Yii::t ( 'app', 'color' ),
				'state_id' => Yii::t ( 'app', 'state' ),
				'type_id' => Yii::t ( 'app', 'type' ),
				'create_user_id' => Yii::t ( 'app', 'create user' ),
				'create_time' => Yii::t ( 'app', 'create time' ),
				'update_time' => Yii::t ( 'app', 'update time' ),
				'product' => null 
		);
	}
	public function search() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'cart_id', $this->cart_id );
		$criteria->compare ( 'product_id', $this->product_id );
		$criteria->compare ( 'amount', $this->amount );
		$criteria->compare ( 'size_id', $this->size_id );
		$criteria->compare ( 'color_id', $this->color_id );
		$criteria->compare ( 'state_id', $this->state_id );
		$criteria->compare ( 'type_id', $this->type_id );
		$criteria->compare ( 'create_user_id', $this->create_user_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'update_time', $this->update_time, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}