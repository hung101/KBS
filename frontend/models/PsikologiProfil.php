<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_psikologi_profil".
 *
 * @property integer $psikologi_profil_id
 * @property string $nama
 * @property string $pangkat
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $emel
 * @property string $facebook
 * @property string $muat_naik
 */
class PsikologiProfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_psikologi_profil';
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
            [['nama', 'pangkat', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 80],
            [['pangkat'], 'integer'],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['alamat_bandar'], 'string', 'max' => 5],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['emel', 'facebook'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 255],
            [['pengalaman_pertandingan'], 'string', 'max' => 50],
            //[['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'psikologi_profil_id' => 'Psikologi Profil ID',
            'nama' => 'Nama',
            'pangkat' => 'Pangkat',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'tarikh_lahir' => 'Tarikh Lahir',
            'jantina' => 'Jantina',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'emel' => 'Emel',
            'facebook' => 'Facebook',
            'muat_naik' => 'Muat Naik',
            'catatan' => 'Catatan',
            'pengalaman_pertandingan' => 'Pengalaman Pertandingan',
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
    
    public function getRefPangkatPsikologi()
    {
        return $this->hasOne(RefPangkatPsikologi::className(), ['id' => 'pangkat']);
    }
}
