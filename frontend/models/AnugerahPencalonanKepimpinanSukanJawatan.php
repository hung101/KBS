<?php

namespace app\models;

use Yii;


use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_lain_jawatan".
 *
 * @property integer $anugerah_pencalonan_lain_jawatan_id
 * @property integer $anugerah_pencalonan_lain_id
 * @property string $jawatan
 * @property string $nama_persatuan_pertubuhan
 * @property string $tempoh
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanKepimpinanSukanJawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_kepimpinan_sukan_jawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_lain_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jawatan', 'nama_persatuan_pertubuhan', 'tempoh'], 'required', 'skipOnEmpty' => true],
            [['tempoh', 'created', 'updated'], 'safe'],
            [['jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_persatuan_pertubuhan', 'session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jawatan','nama_persatuan_pertubuhan'], function ($attribute, $params) {
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
            'anugerah_pencalonan_lain_jawatan_id' => 'Anugerah Pencalonan Lain Jawatan ID',
            'anugerah_pencalonan_lain_id' => 'Anugerah Pencalonan Lain ID',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'nama_persatuan_pertubuhan' => GeneralLabel::nama_persatuan,  //'Nama Persatuan/Pertubuhan',
            'tempoh' => GeneralLabel::tempoh,  //'Tempoh (Tahun)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
