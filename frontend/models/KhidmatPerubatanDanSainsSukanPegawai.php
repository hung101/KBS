<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_khidmat_perubatan_dan_sains_sukan_pegawai".
 *
 * @property integer $khidmat_perubatan_dan_sains_sukan_pegawai_id
 * @property integer $khidmat_perubatan_dan_sains_sukan_id
 * @property string $nama_pegawai
 * @property string $jawatan
 * @property string $agensi
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class KhidmatPerubatanDanSainsSukanPegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_khidmat_perubatan_dan_sains_sukan_pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_pegawai', 'jawatan', 'agensi'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['nama_pegawai', 'jawatan', 'agensi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'khidmat_perubatan_dan_sains_sukan_pegawai_id' => 'Khidmat Perubatan Dan Sains Sukan Pegawai ID',
            'khidmat_perubatan_dan_sains_sukan_id' => 'Khidmat Perubatan Dan Sains Sukan ID',
            'nama_pegawai' => 'Nama Pegawai',
            'jawatan' => 'Jawatan',
            'agensi' => 'Agensi',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
