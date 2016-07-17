<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_gaji_jurulatih".
 *
 * @property integer $gaji_jurulatih_id
 * @property integer $gaji_dan_elaun_jurulatih_id
 * @property string $jumlah
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class GajiJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_gaji_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaji_dan_elaun_jurulatih_id', 'created_by', 'updated_by'], 'integer'],
            [['jumlah'], 'required'],
            [['jumlah'], 'number'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gaji_jurulatih_id' => 'Gaji Jurulatih ID',
            'gaji_dan_elaun_jurulatih_id' => 'Gaji Dan Elaun Jurulatih ID',
            'jumlah' => 'Jumlah (RM)',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
