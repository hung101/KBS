<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            'pengurusan_upstn_id' => GeneralLabel::pengurusan_upstn_id,
            'nama_pengurus_sukan' => GeneralLabel::nama_pengurus_sukan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'tarikh_lawatan' => GeneralLabel::tarikh_lawatan,
            'masa' => GeneralLabel::masa,
            'tempat' => GeneralLabel::tempat,
            'kehadiran' => GeneralLabel::kehadiran,
            'isu' => GeneralLabel::isu,
            'ulasan' => GeneralLabel::ulasan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
}
