<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_kemudahan_ticket_kapal_terbang_jurulatih".
 *
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_id
 * @property integer $jurulatih
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanKemudahanTicketKapalTerbangJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_kemudahan_ticket_kapal_terbang_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_kemudahan_ticket_kapal_terbang_id', 'jurulatih', 'created_by', 'updated_by'], 'integer'],
            [['jurulatih', 'passport_no', 'ic_no', 'hp_no', 'tarikh_pergi', 'tarikh_balik', 'destinasi_pergi', 'destinasi_balik'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated', 'tarikh_pergi', 'tarikh_balik'], 'safe'],
            [['hp_no', 'masa_pergi', 'masa_balik'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['flight_no_pergi', 'flight_no_balik'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id', 'passport_no', 'ic_no'], 'string', 'max' => 100],
            [['destinasi_pergi', 'destinasi_balik', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_kemudahan_ticket_kapal_terbang_jurulatih_id' => 'Permohonan Kemudahan Ticket Kapal Terbang Jurulatih ID',
            'permohonan_kemudahan_ticket_kapal_terbang_id' => 'Permohonan Kemudahan Ticket Kapal Terbang ID',
            'jurulatih' => GeneralLabel::jurulatih,
            'session_id' => 'Session ID',
            'passport_no' => GeneralLabel::passport_no,
            'ic_no' => GeneralLabel::ic_no_s,
            'hp_no' => GeneralLabel::hp_no,
            'tarikh_pergi' => GeneralLabel::tarikh,
            'tarikh_balik' => GeneralLabel::tarikh,
            'flight_no_pergi' => GeneralLabel::flight_no,
            'flight_no_balik' => GeneralLabel::flight_no,
            'masa_pergi' => GeneralLabel::masa,
            'masa_balik' => GeneralLabel::masa,
            'destinasi_pergi' => GeneralLabel::destinasi,
            'destinasi_balik' => GeneralLabel::destinasi,
            'catatan' => GeneralLabel::catatan,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getRefJurulatih()
    {
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
}
