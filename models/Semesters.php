<?php

/**
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property integer $week_number
 * @property integer $call_list
 * @property integer $call_list_short
 *
 * @property CallLists $callListShort
 * @property CallLists $callList
 */
class Semesters extends CActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return '{{semesters}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['name, start_date, end_date, week_number, call_list, call_list_short', 'required'],
            ['week_number, call_list, call_list_short', 'numerical', 'integerOnly' => true],
            ['name', 'length', 'max' => 255],
            ['start_date, end_date', 'date', 'format' => 'yyyy.MM.dd'],
            ['id, name, start_date, end_date, week_number, call_list, call_list_short', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'callListShort' => [self::BELONGS_TO, 'CallLists', 'call_list_short'],
            'callList' => [self::BELONGS_TO, 'CallLists', 'call_list'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата конца',
            'week_number' => 'Номер первой недели',
            'call_list' => 'Список звонков',
            'call_list_short' => 'Список сокращенных звонков',
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('week_number', $this->week_number);
        $criteria->compare('call_list', $this->call_list);
        $criteria->compare('call_list_short', $this->call_list_short);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @param string $className
     * @return Semesters
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
