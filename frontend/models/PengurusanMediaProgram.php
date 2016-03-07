<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_media_program".
 *
 * @property integer $pengurusan_media_program_id
 * @property string $tarikh_mula
 * @property string $nama_program
 * @property string $tempat
 * @property string $cawangan
 * @property string $maklumat_msn_negeri
 * @property string $catatan
 */
class PengurusanMediaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_media_program';
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
            [['tarikh_mula', 'tarikh_tamat', 'nama_program', 'tempat', 'cawangan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_mula'], 'safe'],
            [['nama_program', 'cawangan', 'maklumat_msn_negeri'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_media_program_id' => 'Pengurusan Media Program ID',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'nama_program' => 'Nama Program',
            'tempat' => 'Tempat',
            'cawangan' => 'Bahagian',
            'maklumat_msn_negeri' => 'Maklumat Msn Negeri',
            'catatan' => 'Catatan',
        ];
    }
}
