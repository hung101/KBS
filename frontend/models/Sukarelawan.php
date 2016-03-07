<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_sukarelawan".
 *
 * @property integer $sukarelawan_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $no_tel_bimbit
 * @property string $status
 * @property string $emel
 * @property string $facebook
 * @property integer $kebatasan_fizikal
 * @property string $menyatakan_jika_ada_kebatasan_fizikal
 * @property string $kelulusan_akademi
 * @property string $bidang_kepakaran
 * @property string $pekerjaan_semasa
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $bidang_diminati
 * @property string $waktu_ketika_diperlukan
 * @property string $menyatakan_waktu_ketika_diperlukan
 * @property string $muatnaik
 */
class Sukarelawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sukarelawan';
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
            [['nama', 'no_kad_pengenalan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tarikh_lahir', 'jantina', 'no_tel_bimbit', 'status', 'kebatasan_fizikal', 'kelulusan_akademi', 'bidang_kepakaran', 'pekerjaan_semasa', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'bidang_diminati', 'waktu_ketika_diperlukan', 'menyatakan_waktu_ketika_diperlukan', 'clause'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['kebatasan_fizikal'], 'integer'],
            [['nama', 'menyatakan_jika_ada_kebatasan_fizikal', 'kelulusan_akademi', 'bidang_kepakaran', 'pekerjaan_semasa', 'nama_majikan', 'bidang_diminati', 'waktu_ketika_diperlukan', 'menyatakan_waktu_ketika_diperlukan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'status', 'alamat_majikan_negeri', 'saiz_baju'], 'string', 'max' => 30],
            [['alamat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40],
            [['alamat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['jantina'], 'string', 'max' => 1],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['emel', 'facebook', 'muatnaik', 'bidang_diminati_lain_lain'], 'string', 'max' => 100],
            [['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sukarelawan_id' => 'Sukarelawan ID',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'tarikh_lahir' => 'Tarikh Lahir',
            'jantina' => 'Jantina',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'status' => 'Status Perkahwinan',
            'emel' => 'Emel',
            'facebook' => 'Facebook',
            'saiz_baju' => 'Saiz Baju',
            'kebatasan_fizikal' => 'Kebatasan Fizikal',
            'menyatakan_jika_ada_kebatasan_fizikal' => 'Nyatakan Jika Ada Kebatasan Fizikal',
            'kelulusan_akademi' => 'Kelulusan Akademik',
            'bidang_kepakaran' => 'Bidang Kepakaran',
            'pekerjaan_semasa' => 'Pekerjaan Semasa',
            'nama_majikan' => 'Nama Majikan',
            'alamat_majikan_1' => 'Alamat Majikan',
            'alamat_majikan_2' => '',
            'alamat_majikan_3' => '',
            'alamat_majikan_negeri' => 'Negeri',
            'alamat_majikan_bandar' => 'Bandar',
            'alamat_majikan_poskod' => 'Poskod',
            'bidang_diminati' => 'Bidang Diminati',
            'bidang_diminati_lain_lain' => 'Lain-lain',
            'waktu_ketika_diperlukan' => 'Waktu Ketika Diperlukan',
            'menyatakan_waktu_ketika_diperlukan' => 'Nyatakan Waktu Ketika Diperlukan',
            'muatnaik' => 'Gambar Muat Naik',
            'clause' => 'Saya mengesahan segala maklumat di atas adalah benar mengenai diri saya. Saya, '
            . 'dengan rela hati menawarkan diri untuk sama-sama terlibat dan membantu segala usaha murni sebagai sukarelawan sukan dan sedia berkhidmat. Saya juga'
            . ' akan sentiasa akur dengan peraturan-peraturan dan patuh kepada etika kesukarelawan.',
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
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBandar(){
        return $this->hasOne(RefBandar::className(), ['id' => 'alamat_bandar']);
    }
}
