<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{comment}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Comment".
 *
 * Columns in table "{{comment}}" available as properties of the model,
 * followed by relations of table "{{comment}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $model_type
 * @property integer $model_id
 * @property string $comment
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 *
 * @property User $createUser
 */
abstract class BaseComment extends ActiveRecord {
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
			if (! isset ( $this->create_time ))
				$this->create_time = new CDbExpression ( 'NOW()' );
			if (! isset ( $this->create_user_id ))
				$this->create_user_id = Yii::app ()->user->id;
		} else {
		}
		return parent::beforeValidate ();
	}
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return '{{comment}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', 'Comment|Comments', $n );
	}
	public static function representingColumn() {
		return 'model_type';
	}
	public function rules() {
		return array (
				array (
						'model_type, model_id',
						'required' 
				),
				array (
						'model_id, state_id, create_user_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'model_type',
						'length',
						'max' => 128 
				),
				array (
						'comment, create_time',
						'safe' 
				),
				array (
						'comment, state_id, create_time, create_user_id',
						'default',
						'setOnEmpty' => true,
						'value' => null 
				),
				array (
						'id, model_type, model_id, comment, state_id, create_time, create_user_id',
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
				) 
		);
	}
	public function pivotModels() {
		return array ();
	}
	public function attributeLabels() {
		return array (
				'id' => Yii::t ( 'app', 'ID' ),
				'model_type' => Yii::t ( 'app', 'model type' ),
				'model_id' => Yii::t ( 'app', 'model' ),
				'comment' => Yii::t ( 'app', 'comment' ),
				'state_id' => Yii::t ( 'app', 'state' ),
				'create_time' => Yii::t ( 'app', 'create time' ),
				'create_user_id' => null,
				'createUser' => null 
		);
	}
	public function search() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'model_type', $this->model_type, true );
		$criteria->compare ( 'model_id', $this->model_id );
		$criteria->compare ( 'comment', $this->comment, true );
		$criteria->compare ( 'state_id', $this->state_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'create_user_id', $this->create_user_id );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}