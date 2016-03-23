<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih".
 *
 * @property integer $pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id
 * @property string $jurulatih
 * @property string $muatnaik_gambar
 * @property string $cawangan
 * @property string $sub_cawangan
 * @property string $program_msn
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_jurulatih
 * @property string $status_permohonan
 * @property string $status_keaktifan_jurulatih
 * @property string $muat_naik_document
 */
class PengurusanPenyambunganDanPenamatanKontrakJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih';
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
            [['jurulatih', 'tarikh_mula', 'status_permohonan', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true],
            [['jurulatih'], 'integer'],
            //[[ 'muat_naik_document'], 'string', 'max' => 100],
            [['status_permohonan'], 'string', 'max' => 30],
            [['muat_naik_document'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id' => GeneralLabel::pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id,
            'jurulatih' => GeneralLabel::jurulatih,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'muat_naik_document' => GeneralLabel::muat_naik_document,

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
    
    public function getRefJurulatih()
    {
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
    
    public function getRefStatusPermohonanKontrakJurulatih()
    {
        return $this->hasOne(RefStatusPermohonanKontrakJurulatih::className(), ['id' => 'status_permohonan']);
    }
}
