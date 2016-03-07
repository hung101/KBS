<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

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
            [['tarikh', 'tempat', 'mengikut_perlembagaan', 'kehadiran_ahli_yang_layak_mengundi', 'status'], 'required', 'skipOnEmpty' => true],
            [['tarikh', 'masa'], 'safe'],
            [['jumlah_ahli_yang_hadir', 'korum_mesyuarat_jumlah_ahli_yang_hadir', 'profil_badan_sukan_id', 'status'], 'integer'],
            [['tempat'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 30],
            [['mengikut_perlembagaan'], 'string', 'max' => 255],
            [['agenda_mesyuarat', 'keputusan_mesyuarat'], 'string', 'max' => 255],
            [['minit_ajk_muat_naik', 'notis_agm_muat_naik', 'minit_agm_muat_naik', 'laporan_kewangan_muat_naik', 'laporan_aktiviti_muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mesyuarat_id' => 'Mesyuarat ID',
            'tarikh' => 'Tarikh & Masa',
            'profil_badan_sukan_id' => 'Badan Sukan',
            'masa' => 'Masa',
            'tempat' => 'Tempat',
            'mengikut_perlembagaan' => 'Korum Mesyuarat Mengikut Perlembagaan',
            'korum_mesyuarat_jumlah_ahli_yang_hadir' => 'Korum Mesyuarat Jumlah Ahli Yang Hadir',
            'jumlah_ahli_yang_hadir' => 'Jumlah Ahli Yang Hadir',
            'agenda_mesyuarat' => 'Agenda Mesyuarat',
            'keputusan_mesyuarat' => 'Keputusan Mesyuarat',
            'minit_ajk_muat_naik' => 'Minit AJK',
            'notis_agm_muat_naik' => 'Notis AGM',
            'minit_agm_muat_naik' => 'Minit AGM',
            'laporan_kewangan_muat_naik' => 'Laporan Kewangan',
            'laporan_aktiviti_muat_naik' => 'Laporan Aktiviti',
            'status' => 'Status',
            
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
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'profil_badan_sukan_id']);
    }
}
