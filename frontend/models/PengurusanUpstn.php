<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_upstn".
 *
 * @property integer $pengurusan_upstn_id
 * @property string $nama_pengurus_sukan
 * @property string $nama_sukan
 * @property string $tarikh_lawatan
 * @property string $masa
 * @property string $tempat
 * @property string $kehadiran
 * @property string $isu
 * @property string $ulasan
 */
class PengurusanUpstn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_upstn';
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
            [['nama_pengurus_sukan', 'nama_sukan', 'tarikh_lawatan', 'tempat', 'kehadiran', 'isu'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lawatan', 'masa'], 'safe'],
            [['nama_pengurus_sukan', 'nama_sukan'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['kehadiran', 'isu', 'ulasan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_upstn_id' => 'Pengurusan Upstn ID',
            'nama_pengurus_sukan' => 'Nama Pengurus Sukan',
            'nama_sukan' => 'Nama Sukan',
            'tarikh_lawatan' => 'Tarikh & Masa Lawatan',
            'masa' => 'Masa',
            'tempat' => 'Tempat',
            'kehadiran' => 'Kehadiran',
            'isu' => 'Isu',
            'ulasan' => 'Ulasan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
}
