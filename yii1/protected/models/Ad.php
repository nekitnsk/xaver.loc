<?php

/**
 * This is the model class for table "ad".
 *
 * The followings are the available columns in table 'ad':
 * @property integer $id
 * @property integer $whois
 * @property string $name
 * @property string $email
 * @property integer $subscribe
 * @property string $phone
 * @property integer $city
 * @property integer $category
 * @property string $title
 * @property string $message
 * @property integer $price
 * @property string $datatime_create
 * @property integer $active
 */
class Ad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, subscribe, phone, city, category, title, message, price, datatime_create', 'required'),
			array('whois, subscribe, city, category, price, active', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('email', 'length', 'max'=>40),
			array('phone', 'length', 'max'=>11),
			array('title', 'length', 'max'=>100),
			array('message', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, whois, name, email, subscribe, phone, city, category, title, message, price, datatime_create, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'whois' => 'Whois',
			'name' => 'Name',
			'email' => 'Email',
			'subscribe' => 'Subscribe',
			'phone' => 'Phone',
			'city' => 'City',
			'category' => 'Category',
			'title' => 'Title',
			'message' => 'Message',
			'price' => 'Price',
			'datatime_create' => 'Datatime Create',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('whois',$this->whois);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('subscribe',$this->subscribe);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city',$this->city);
		$criteria->compare('category',$this->category);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('datatime_create',$this->datatime_create,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
