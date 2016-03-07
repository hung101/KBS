<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_program_persatuan".
 *
 * @property integer $pengurusan_program_persatuan
 * @property string $bantuan_tahun
 * @property string $nama_persatuan
 */
class PengurusanProgramPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_persatuan';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_tahun', 'nama_persatuan'], 'required', 'skipOnEmpty' => true],
            [['bantuan_tahun'], 'safe'],
            [['nama_persatuan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_persatuan' => 'Pengurusan Program Persatuan',
            'bantuan_tahun' => 'Bantuan Tahun',
            'nama_persatuan' => 'Nama Persatuan',
        ];
    }
}
