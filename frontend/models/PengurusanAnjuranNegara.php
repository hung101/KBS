<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_anjuran_negara".
 *
 * @property integer $pengurusan_anjuran_negara_id
 * @property integer $pengurusan_anjuran_id
 * @property string $negara
 * @property string $nama_delegasi_luar_negara
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanAnjuranNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_anjuran_negara';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_delegasi_luar_negara', 'negara'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_anjuran_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['nama_delegasi_luar_negara'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negara'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_anjuran_negara_id' => 'Pengurusan Anjuran Negara ID',
            'pengurusan_anjuran_id' => 'Pengurusan Anjuran ID',
            'negara' => 'Negara',
            'nama_delegasi_luar_negara' => 'Nama Delegasi Luar Negara',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'negara']);
    }
}
