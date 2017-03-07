<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

class PengurusanProgramBinaanKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_kategori';
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
            [['kategori'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_program_binaan_id', 'kategori', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_binaan_kategori_id' => 'Pengurusan Program Binaan Kategori ID',
            'pengurusan_program_binaan_id' => 'Pengurusan Program Binaan ID',
            'kategori' => GeneralLabel::kategori,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriProgramBinaan(){
        return $this->hasOne(RefKategoriProgramBinaan::className(), ['id' => 'kategori']);
    }
}
