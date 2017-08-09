<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_penginapan".
 *
 * @property integer $pengurusan_penginapan_id
 * @property integer $atlet_id
 * @property string $nama_pegawai
 * @property string $tarikh_masa_penginapan_mula
 * @property string $tarikh_masa_penginapan_akhir
 * @property string $lokasi
 * @property string $nama_penginapan
 */
class PengurusanPenginapan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penginapan';
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
            [['atlet_id', 'nama_pegawai', 'tarikh_masa_penginapan_mula', 'tarikh_masa_penginapan_akhir', 'lokasi', 'nama_penginapan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_masa_penginapan_mula', 'tarikh_masa_penginapan_akhir'], 'safe'],
            [['nama_pegawai', 'nama_penginapan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pegawai', 'nama_penginapan','lokasi','catatan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penginapan_id' => GeneralLabel::pengurusan_penginapan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_pegawai' => GeneralLabel::nama_pegawai,
            'tarikh_masa_penginapan_mula' => GeneralLabel::tarikh_masa_penginapan_mula,
            'tarikh_masa_penginapan_akhir' => GeneralLabel::tarikh_masa_penginapan_akhir,
            'lokasi' => GeneralLabel::lokasi,
            'nama_penginapan' => GeneralLabel::nama_penginapan,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPegawaiPengurusanPenginapan(){
        return $this->hasOne(RefPegawaiPengurusanPenginapan::className(), ['id' => 'nama_pegawai']);
    }
}
