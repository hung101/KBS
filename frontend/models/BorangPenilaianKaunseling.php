<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_penilaian_kaunseling".
 *
 * @property integer $borang_penilaian_kaunseling_id
 * @property integer $profil_konsultan_id
 * @property string $diagnosis
 * @property string $preskripsi
 * @property string $cadangan
 * @property string $rujukan
 * @property string $tindakan_selanjutnya
 * @property string $kategori_permasalahan
 * @property string $tarikh_temujanji
 */
class BorangPenilaianKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_penilaian_kaunseling';
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
            [['profil_konsultan_id', 'diagnosis', 'kategori_permasalahan', 'jenis_klien'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_konsultan_id', 'atlet', 'jurulatih', 'jenis_klien'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_temujanji'], 'safe'],
            [['diagnosis', 'preskripsi', 'cadangan', 'rujukan', 'tindakan_selanjutnya', 'kategori_permasalahan', 'lain_lain_nyatakan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
			[['pegawai_anggota'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
			['atlet', 'required', 'when' => function ($model) {
				return $model->jenis_klien === '1';
			}, 'whenClient' => "function (attribute, value) {
				return $('#jenisKlienID').val() === '1';
			}", 'message' => GeneralMessage::yii_validation_required],
			['jurulatih', 'required', 'when' => function ($model) {
				return $model->jenis_klien === '2';
			}, 'whenClient' => "function (attribute, value) {
				return $('#jenisKlienID').val() === '2';
			}", 'message' => GeneralMessage::yii_validation_required],
			['pegawai_anggota', 'required', 'when' => function ($model) {
				return $model->jenis_klien === '3';
			}, 'whenClient' => "function (attribute, value) {
				return $('#jenisKlienID').val() === '3';
			}", 'message' => GeneralMessage::yii_validation_required],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_penilaian_kaunseling_id' => GeneralLabel::borang_penilaian_kaunseling_id,
            'profil_konsultan_id' => GeneralLabel::profil_konsultan_id,
			'jenis_klien' => GeneralLabel::jenis_klien,
            'atlet' => GeneralLabel::atlet,
			'jurulatih' => GeneralLabel::jurulatih,
			'pegawai_anggota' => GeneralLabel::pegawai_anggota,
            'diagnosis' => GeneralLabel::diagnosis,
            'preskripsi' => GeneralLabel::preskripsi,
            'cadangan' => GeneralLabel::cadangan,
            'rujukan' => GeneralLabel::rujukan,
            'tindakan_selanjutnya' => GeneralLabel::tindakan_selanjutnya,
            'kategori_permasalahan' => GeneralLabel::kategori_permasalahan,
            'tarikh_temujanji' => GeneralLabel::tarikh_temujanji,
            'lain_lain_nyatakan' => GeneralLabel::nyatakan_jika_lain_lain  //'Lain-lain Nyatakan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUser(){
        return $this->hasOne(User::className(), ['id' => 'profil_konsultan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKlien(){
        return $this->hasOne(RefJenisKlien::className(), ['id' => 'jenis_klien']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriMasalahKaunseling(){
        return $this->hasOne(RefLatarbelakangKes::className(), ['id' => 'kategori_permasalahan']);
    }
}
