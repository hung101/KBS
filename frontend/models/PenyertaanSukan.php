<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penyertaan_sukan".
 *
 * @property integer $penyertaan_sukan_id
 * @property string $nama_sukan
 * @property string $tempat_penginapan
 * @property string $tempat_latihan
 * @property string $nama_atlet
 * @property string $nama_pegawai
 * @property string $jawatan_pegawai
 * @property string $nama_pengurus_sukan
 * @property string $nama_sukarelawan
 */
class PenyertaanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan';
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
            [['peringkat', 'program', 'nama_sukan', 'tempat_penginapan', 'nama_atlet',
               'tarikh_mula', 'tarikh_tamat', 'tempat_latihan', 'nama_kejohanan_temasya', 'kategori'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['mesyuarat_id', 'penilaian_pestasi_id', 'nama_kejohanan_temasya', 'jkb_status_permohonan', 'kategori'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jkb_jumlah_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_jkb'], 'safe'],
            [['nama_sukan', 'nama_kejohanan', 'nama_pegawai', 'jawatan_pegawai', 'nama_pengurus_sukan', 'nama_sukarelawan', 'nama_temasya', 'bilangan_jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat_penginapan', 'tempat_latihan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sasaran_kejohanan', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyertaan_sukan_id' => GeneralLabel::penyertaan_sukan_id,
            'kategori_penilaian' => GeneralLabel::kategori_penilaian,
            'nama_temasya' => GeneralLabel::nama_temasya,
            'peringkat' => GeneralLabel::peringkat,
            'nama_kejohanan' => GeneralLabel::nama_kejohanan,
            'nama_sukan' => GeneralLabel::sukan,
            'tempat_penginapan' => GeneralLabel::tempat,
            'tempat_latihan' => GeneralLabel::tempat_latihan,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'nama_pegawai' => GeneralLabel::nama_pegawai,
            'jawatan_pegawai' => GeneralLabel::jawatan_pegawai,
            'nama_pengurus_sukan' => GeneralLabel::nama_pengurus_sukan,
            'nama_sukarelawan' => GeneralLabel::nama_sukarelawan,
            'nama_sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'nama_kejohanan_temasya' => GeneralLabel::nama_kejohanan_temasya,
            'sasaran_kejohanan' => GeneralLabel::sasaran_kejohanan,
            'catatan' => GeneralLabel::catatan,
            'jkb_status_permohonan' => GeneralLabel::status_permohonan,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'jkb_jumlah_diluluskan' => GeneralLabel::jumlah_diluluskan,
            'kategori' => GeneralLabel::kategori,
        ];
    }
    
    public function beforeValidate()
    {
         if (parent::beforeValidate())
         {
            // if (($this->nama_kejohanan==null)&&($this->nama_temasya==null))      
            // {
                    // $this->addError('nama_kejohanan', GeneralMessage::yii_validation_required_either);
                    // $this->addError('nama_temasya', GeneralMessage::yii_validation_required_either);
                    // return false;
            // } else if (($this->nama_kejohanan!=null)&&($this->nama_temasya!=null))      
            // {
                    // $this->addError('nama_kejohanan', GeneralMessage::yii_validation_required_only_one);
                    // $this->addError('nama_temasya', GeneralMessage::yii_validation_required_only_one);
                    // return false;
            // }

            return true;
         }
         return false;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
}
