<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_lain".
 *
 * @property integer $anugerah_pencalonan_lain_id
 * @property string $kategori
 * @property string $nama
 * @property string $gambar
 * @property string $no_kad_pengenalan
 * @property string $no_tel_1
 * @property string $no_tel_2
 * @property string $sumbangan_dalam_pencapaian
 * @property string $ulasan_justifikasi
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanKepimpinanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_kepimpinan_sukan';
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
            [['kategori', 'nama', 'no_tel_1'], 'required', 'skipOnEmpty' => true],
            [['sumbangan_dalam_pencapaian', 'ulasan_justifikasi'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kategori'], 'string', 'max' => 30],
            [['nama'], 'string', 'max' => 80],
            [['gambar'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_tel_1', 'no_tel_2'], 'string', 'max' => 14],
                        [['no_tel_1', 'no_tel_2'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['gambar'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_lain_id' => 'Anugerah Pencalonan Lain ID',
            'kategori' => 'Kategori',
            'nama' => 'Nama',
            'gambar' => 'Gambar',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_tel_1' => 'No Telefon 1',
            'no_tel_2' => 'No Telefon 2',
            'sumbangan_dalam_pencapaian' => 'Sumbangan Dalam Aspek Kepimpinan, Pengurusan Dan Perkhidmatan Yang Cemerlang Untuk Kemajuan Sukan Negara',
            'ulasan_justifikasi' => 'Ulasan / Justifikasi Pencalonan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
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
    public function getRefKategoriPencalonanLain(){
        return $this->hasOne(RefKategoriPencalonanLain::className(), ['id' => 'kategori']);
    }
}
