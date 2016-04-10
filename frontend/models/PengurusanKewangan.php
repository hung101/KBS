<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kewangan".
 *
 * @property integer $pengurusan_kewangan_id
 * @property string $nama_acara_program
 * @property string $tarikh_acara
 * @property string $kategori_acara
 * @property string $objektif
 * @property string $kategori_penggunaan
 * @property string $harga_penggunaan
 * @property string $jumlah_bajet
 * @property string $jumlah_penggunaan
 * @property string $catatan
 * @property string $bajet_keseluruhan
 * @property string $penggunaan_keseluruhan
 * @property string $baki
 */
class PengurusanKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kewangan';
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
            [['nama_acara_program', 'tarikh_acara', 'kategori_penggunaan', 'harga_penggunaan', 'jumlah_bajet', 'jumlah_penggunaan', 'bajet_keseluruhan', 'penggunaan_keseluruhan', 'baki'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_acara'], 'safe'],
            [['harga_penggunaan', 'jumlah_bajet', 'jumlah_penggunaan', 'bajet_keseluruhan', 'penggunaan_keseluruhan', 'baki'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_acara_program', 'kategori_acara', 'kategori_penggunaan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['objektif', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kewangan_id' => GeneralLabel::pengurusan_kewangan_id,
            'nama_acara_program' => GeneralLabel::nama_acara_program,
            'tarikh_acara' => GeneralLabel::tarikh_acara,
            'kategori_acara' => GeneralLabel::kategori_acara,
            'objektif' => GeneralLabel::objektif,
            'kategori_penggunaan' => GeneralLabel::kategori_penggunaan,
            'harga_penggunaan' => GeneralLabel::harga_penggunaan,
            'jumlah_bajet' => GeneralLabel::jumlah_bajet,
            'jumlah_penggunaan' => GeneralLabel::jumlah_penggunaan,
            'catatan' => GeneralLabel::catatan,
            'bajet_keseluruhan' => GeneralLabel::bajet_keseluruhan,
            'penggunaan_keseluruhan' => GeneralLabel::penggunaan_keseluruhan,
            'baki' => GeneralLabel::baki,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_acara_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPenggunaan(){
        return $this->hasOne(RefKategoriPenggunaan::className(), ['id' => 'kategori_penggunaan']);
    }
}
