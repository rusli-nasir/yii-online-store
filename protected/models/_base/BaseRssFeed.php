<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * This is the model base class for the table "{{rss_feed}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "RssFeed".
 *
 * Columns in table "{{rss_feed}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $state_id
 * @property string $create_time
 * @property string $update_time
 *
 */
abstract class BaseRssFeed extends ActiveRecord {

	
	public static function getStatusOptions($id = null)
	{
		$list = array("Draft","Published","Archive");
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id ];
		return $id;
	}	

	
	
	
	
	
		public function beforeValidate()
	{
		if($this->isNewRecord)
		{
			if ( !isset( $this->create_time )) $this->create_time = date('Y-m-d H:i:s');
			}else{
				}
		return parent::beforeValidate();
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{rss_feed}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'RssFeed|RssFeeds', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, url, create_time', 'required'),
			array('state_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('url', 'length', 'max'=>1052),
			array('image_url','safe'),
			array('state_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, url, state_id, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'url' => Yii::t('app', 'Url'),
			'state_id' => Yii::t('app', 'State'),
			'create_time' => Yii::t('app', 'Create Time'),
			'update_time' => Yii::t('app', 'Update Time'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}