<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_tel_bimbit'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pangkat'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel', 'facebook'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pengalaman_pertandingan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['muat_naik'], 'string', 'max' => 100],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama','alamat_1', 'alamat_2', 'alamat_3','alamat_negeri','alamat_bandar','emel', 'facebook','catatan','pengalaman_pertandingan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'psikologi_profil_id' => GeneralLabel::psikologi_profil_id,
            'nama' => GeneralLabel::nama,
            'pangkat' => GeneralLabel::pangkat,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'jantina' => GeneralLabel::jantina,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'muat_naik' => GeneralLabel::muat_naik,
            'catatan' => GeneralLabel::catatan,
            'pengalaman_pertandingan' => GeneralLabel::pengalaman_pertandingan,

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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
    public function getRefPangkatPsikologi()
    {
        return $this->hasOne(RefPangkatPsikologi::className(), ['id' => 'pangkat']);
    }
}
