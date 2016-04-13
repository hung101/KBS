<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_pemantauan_dan_penilaian_jurulatih".
 *
 * @property integer $pengurusan_pemantauan_dan_penilaian_jurulatih_id
 * @property string $nama_jurulatih_dinilai
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $pusat_latihan
 */
class PengurusanPemantauanDanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_pemantauan_dan_penilaian_jurulatih';
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
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan', 'penilaian_oleh', 'tarikh_dinilai'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => GeneralLabel::pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'nama_jurulatih_dinilai' => GeneralLabel::nama_jurulatih_dinilai,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'pusat_latihan' => GeneralLabel::pusat_latihan,
            'penilaian_oleh' => GeneralLabel::penilaian_oleh,
            'tarikh_dinilai' => GeneralLabel::tarikh_dinilai,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih_dinilai']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
