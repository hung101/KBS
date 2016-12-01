<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_konsultan_kontrak".
 *
 * @property integer $profil_konsultan_kontrak_id
 * @property integer $profil_konsultan_id
 * @property string $tarikh_kontrak_mula
 * @property string $tarikh_kontrak_akhir
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilKonsultanKontrak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_konsultan_kontrak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_konsultan_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_kontrak_mula', 'tarikh_kontrak_akhir'], 'required'],
            [['tarikh_kontrak_mula', 'tarikh_kontrak_akhir', 'created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_konsultan_kontrak_id' => 'Profil Konsultan Kontrak ID',
            'profil_konsultan_id' => 'Profil Konsultan ID',
            'tarikh_kontrak_mula' => GeneralLabel::tarikh_kontrak_mula,  //'Tarikh Kontrak (Mula)',
            'tarikh_kontrak_akhir' => GeneralLabel::tarikh_kontrak_tamat,  //'Tarikh Kontrak (Akhir)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
