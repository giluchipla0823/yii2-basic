<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubigeo".
 *
 * @property int $id
 * @property string $department_id
 * @property string $province_id
 * @property string $district_id
 * @property string $description
 * @property string $status
 */
class Ubigeo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ubigeo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'province_id', 'district_id', 'description', 'status'], 'required'],
            [['id'], 'integer'],
            [['department_id', 'province_id', 'district_id'], 'string', 'max' => 2],
            [['description'], 'string', 'max' => 150],
            [['status'], 'string', 'max' => 1],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
