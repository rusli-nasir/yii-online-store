<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{category}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Category".
 *
 * Columns in table "{{category}}" available as properties of the model,
 * followed by relations of table "{{category}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image_file
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $createUser
 * @property SubCategory[] $subCategories
 */
abstract class BaseCategory extends ActiveRecord {
	const CATEGORY_ACCESSORY = 0;
	const CATEGORY_GIFT = 1;
	const TYPE_PARENT = 0;
	const TYPE_CHILD = 1;
	public static function getCategoryOptions($id = null) {
		$list = array (
				self::CATEGORY_ACCESSORY => 'accessory',
				self::CATEGORY_GIFT => 'gift' 
		);
		if ($id == null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id];
		return $id;
	}
	public static function getTypeOptions($id = null) {
		$list = array (
				"Parent",
				"Child" 
		);
		if ($id == null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id];
		return $id;
	}
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
		return '{{category}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', 'Category|Categories', $n );
	}
	public static function representingColumn() {
		return 'title';
	}
	public function rules() {
		return array (
				array (
						'title',
						
						'required', 
						
				),
				array (
						'type_id, state_id, create_user_id', 
						
						'numerical',
						'integerOnly' => true 
				),
				array (
						'title, description',
						'length',
						'max' => 256 
				),
				array (
						'image_file',
						'length',
						'max' => 1024 
				),
				array (
						'parent_id',
						
						'safe' 
				),
				array (
						'type_id, state_id',
						'default',
						'setOnEmpty' => true,
						'value' => null 
				),
				array (
						'id, title, description, image_file, type_id, state_id, create_user_id, create_time, update_time',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	public function relations() {
		return array (
				'createUser' => array (
						self::BELONGS_TO,
						'User',
						'create_user_id' 
				),
				'subCategories' => array (
						self::HAS_MANY,
						'Category',
						'parent_id' 
				) 
		);
	}
	public function pivotModels() {
		return array ();
	}
	public function attributeLabels() {
		return array (
				'id' => Yii::t ( 'app', 'ID' ),
				'title' => Yii::t ( 'app', 'title' ),
				'description' => Yii::t ( 'app', 'description' ),
				'image_file' => Yii::t ( 'app', 'image file' ),
				'order_no' => Yii::t ( 'app', 'order no' ),
				'type_id' => Yii::t ( 'app', 'type' ),
				'state_id' => Yii::t ( 'app', 'state' ),
				'create_user_id' => null,
				'create_time' => Yii::t ( 'app', 'create time' ),
				'update_time' => Yii::t ( 'app', 'update time' ),
				'createUser' => null,
				'subCategories' => null 
		);
	}
	public function search() {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'type_id', Category::CATEGORY_MAIN);
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'title', $this->title, true );
		$criteria->compare ( 'description', $this->description, true );
		$criteria->compare ( 'image_file', $this->image_file, true );
		$criteria->compare ( 'type_id', $this->type_id );
		$criteria->compare ( 'state_id', $this->state_id );
		$criteria->compare ( 'create_user_id', $this->create_user_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'update_time', $this->update_time, true );
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria ,
				'pagination'=>array(
						'pagesize'=>20,
				)
		) );
	}
}