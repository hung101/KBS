<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_akademi_akk".
 *
 * @property integer $akademi_akk_id
 * @property string $nama
 * @property string $muatnaik_gambar
 * @property string $no_kad_pengenalan
 * @property string $no_passport
 * @property string $tarikh_lahir
 * @property string $tempat_lahir
 * @property string $no_telefon
 * @property string $emel
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_telefon_pejabat
 * @property string $kategori_pensijilan
 */
class AkademiAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_akademi_akk';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'tempat_lahir', 'no_telefon', 'kategori_pensijilan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['nama', 'nama_majikan'], 'string', 'max' => 80],
            [['senarai_nama_peserta', 'emel'], 'string', 'max' => 255],
            [['muatnaik_gambar', 'emel'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_passport'], 'string', 'max' => 15],
            [['tempat_lahir', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['no_telefon', 'no_telefon_pejabat'], 'string', 'max' => 14],
            [['alamat_majikan_negeri', 'kategori_pensijilan'], 'string', 'max' => 30],
            [['alamat_majikan_bandar'], 'string', 'max' => 40],
            [['alamat_majikan_poskod'], 'string', 'max' => 5],
            [['muatnaik_gambar'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akademi_akk_id' => 'Akademi Akk ID',
            'senarai_nama_peserta' => 'Senarai Nama Peserta',
            'nama' => 'Nama',
            'muatnaik_gambar' => 'Muatnaik Gambar',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_passport' => 'No Passport',
            'tarikh_lahir' => 'Tarikh Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'no_telefon' => 'No Telefon',
            'emel' => 'Emel',
            'nama_majikan' => 'Nama Majikan',
            'alamat_majikan_1' => 'Alamat Majikan',
            'alamat_majikan_2' => '',
            'alamat_majikan_3' => '',
            'alamat_majikan_negeri' => 'Negeri',
            'alamat_majikan_bandar' => 'Bandar',
            'alamat_majikan_poskod' => 'Poskod',
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'kategori_pensijilan' => 'Kategori Pensijilan',
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
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama']);
    }
    
    public function getRefKategoriPensijilanAkademiAkk()
    {
        return $this->hasOne(RefKategoriPensijilanAkademiAkk::className(), ['id' => 'kategori_pensijilan']);
    }
}
