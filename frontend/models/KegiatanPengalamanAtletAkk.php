<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_kegiatan_pengalaman_atlet_akk".
 *
 * @property integer $kegiatan_pengalaman_atlet_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_sukan_pertandingan
 * @property string $tahun
 * @property string $sukan_acara
 * @property string $pencapaian
 */
class KegiatanPengalamanAtletAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kegiatan_pengalaman_atlet_akk';
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
            [['nama_sukan_pertandingan', 'tahun', 'sukan_acara', 'pencapaian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['akademi_akk_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun'], 'safe'],
            [['nama_sukan_pertandingan', 'sukan_acara', 'pencapaian'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kegiatan_pengalaman_atlet_akk_id' => GeneralLabel::kegiatan_pengalaman_atlet_akk_id,
            'akademi_akk_id' => GeneralLabel::akademi_akk_id,
            'nama_sukan_pertandingan' => GeneralLabel::nama_sukan_pertandingan,
            'tahun' => GeneralLabel::tahun,
            'sukan_acara' => GeneralLabel::sukan_acara,
            'pencapaian' => GeneralLabel::pencapaian,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'sukan_acara']);
    }
}
