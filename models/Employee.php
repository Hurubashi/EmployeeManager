<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property int $salary
 * @property string $start
 * @property string $end
 * @property int $phone
 * @property string $address
 *
 * @property Task[] $tasks
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'position', 'salary', 'start'], 'required'],
            [['salary', 'phone'], 'integer'],
            [['start', 'end'], 'safe'],
            [['name', 'position', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'position' => 'Position',
            'salary' => 'Salary',
            'start' => 'Start',
            'end' => 'End',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['employee_id' => 'id']);
    }
}
