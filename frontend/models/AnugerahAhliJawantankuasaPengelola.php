<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_anugerah_ahli_jawantankuasa_pengelola".
 *
 * @property integer $anugerah_ahli_jawantankuasa_pengelola_id
 * @property string $ajk
 * @property string $nama
 * @property string $bahagian
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahAhliJawantankuasaPengelola extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_ahli_jawantankuasa_pengelola';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ajk', 'nama', 'bahagian'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['ajk', 'nama', 'bahagian'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_ahli_jawantankuasa_pengelola_id' => 'Anugerah Ahli Jawantankuasa Pengelola ID',
            'ajk' => 'AJK',
            'nama' => 'Nama',
            'bahagian' => 'Bahagian',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
