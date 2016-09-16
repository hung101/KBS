<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ltbs_minit_mesyuarat_jawatankuasa".
 *
 * @property integer $mesyuarat_id
 * @property string $tarikh
 * @property string $masa
 * @property string $tempat
 * @property string $mengikut_perlembagaan
 * @property integer $jumlah_ahli_yang_hadir
 */
class LtbsMinitMesyuaratJawatankuasa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_minit_mesyuarat_jawatankuasa';
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
            [['tarikh', 'tempat', 'mengikut_perlembagaan', 'kehadiran_ahli_yang_layak_mengundi', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'masa'], 'safe'],
            [['jumlah_ahli_yang_hadir', 'korum_mesyuarat_jumlah_ahli_yang_hadir', 'profil_badan_sukan_id', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tempat'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['mengikut_perlembagaan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agenda_mesyuarat', 'keputusan_mesyuarat'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['minit_ajk_muat_naik', 'notis_agm_muat_naik', 'minit_agm_muat_naik', 'laporan_kewangan_muat_naik', 'laporan_aktiviti_muat_naik',
                'borang_pt_muat_naik', 'senarai_ahli_jawatankuasa_muat_naik', 'senarai_ahli_gabungan_terkini_muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mesyuarat_id' => GeneralLabel::mesyuarat_id,
            'tarikh' => GeneralLabel::tarikh,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'masa' => GeneralLabel::masa,
            'tempat' => GeneralLabel::tempat,
            'mengikut_perlembagaan' => GeneralLabel::mengikut_perlembagaan,
            'korum_mesyuarat_jumlah_ahli_yang_hadir' => GeneralLabel::korum_mesyuarat_jumlah_ahli_yang_hadir,
            'jumlah_ahli_yang_hadir' => GeneralLabel::jumlah_ahli_yang_hadir,
            'agenda_mesyuarat' => GeneralLabel::agenda_mesyuarat,
            'keputusan_mesyuarat' => GeneralLabel::keputusan_mesyuarat,
            'minit_ajk_muat_naik' => GeneralLabel::minit_ajk_muat_naik,
            'notis_agm_muat_naik' => GeneralLabel::notis_agm_muat_naik,
            'minit_agm_muat_naik' => GeneralLabel::minit_agm_muat_naik,
            'laporan_kewangan_muat_naik' => GeneralLabel::laporan_kewangan_muat_naik,
            'laporan_aktiviti_muat_naik' => GeneralLabel::laporan_aktiviti_muat_naik,
            'borang_pt_muat_naik' => 'Borang PT 1@2 / MYKB 1@2',
            'senarai_ahli_jawatankuasa_muat_naik' => 'Senarai Ahli Jawatankuasa',
            'senarai_ahli_gabungan_terkini_muat_naik' => 'Senarai Ahli / Gabungan Terkini',
            'status' => GeneralLabel::status,
            'catatan' => GeneralLabel::catatan,
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'profil_badan_sukan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusLaporanMesyuaratAgung(){
        return $this->hasOne(RefStatusLaporanMesyuaratAgung::className(), ['id' => 'status']);
    }
}
