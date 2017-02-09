<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_lawatan_rasmi_luar_negara_pegawai".
 *
 * @property integer $lawatan_rasmi_luar_negara_pegawai_id
 * @property integer $lawatan_rasmi_luar_negara_id
 * @property string $nama_pegawai_terlibat
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LawatanRasmiLuarNegaraPegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lawatan_rasmi_luar_negara_pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lawatan_rasmi_luar_negara_id', 'created_by', 'updated_by'], 'integer'],
            [['nama_pegawai_terlibat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['nama_pegawai_terlibat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lawatan_rasmi_luar_negara_pegawai_id' => 'Lawatan Rasmi Luar Negara Pegawai ID',
            'lawatan_rasmi_luar_negara_id' => 'Lawatan Rasmi Luar Negara ID',
            'nama_pegawai_terlibat' => GeneralLabel::nama_pegawai_terlibat,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
