<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_manual_silibus_kurikulum_teknikal_kepegawaian".
 *
 * @property integer $manual_silibus_kurikulum_teknikal_kepegawaian_id
 * @property string $persatuan_sukan
 * @property string $jilid_versi
 * @property string $tarikh
 * @property string $muat_naik
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ManualSilibusKurikulumTeknikalKepegawaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_manual_silibus_kurikulum_teknikal_kepegawaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh', 'persatuan_sukan', 'jilid_versi'], 'required'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['persatuan_sukan', 'jilid_versi'], 'string', 'max' => 30],
            [['muat_naik'], 'string', 'max' => 255],
            [['muat_naik'], 'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manual_silibus_kurikulum_teknikal_kepegawaian_id' => 'Manual Silibus Kurikulum Teknikal Kepegawaian ID',
            'persatuan_sukan' => 'Persatuan Sukan',
            'jilid_versi' => 'Jilid / Versi',
            'tarikh' => 'Tarikh',
            'muat_naik' => 'Muat Naik',
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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'persatuan_sukan']);
    }
}
