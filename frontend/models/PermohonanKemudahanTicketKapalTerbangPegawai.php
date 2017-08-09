<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_kemudahan_ticket_kapal_terbang_pegawai".
 *
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_pegawai_id
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_id
 * @property string $pegawai
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanKemudahanTicketKapalTerbangPegawai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_kemudahan_ticket_kapal_terbang_pegawai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_kemudahan_ticket_kapal_terbang_id', 'created_by', 'updated_by'], 'integer'],
            [['pegawai', 'passport_no', 'ic_no', 'hp_no'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated', 'tarikh_pergi', 'tarikh_balik'], 'safe'],
            [['hp_no', 'masa_pergi', 'masa_balik'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['flight_no_pergi', 'flight_no_balik'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id', 'passport_no', 'ic_no'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['destinasi_pergi', 'destinasi_balik', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai','hp_no', 'masa_pergi', 'masa_balik','flight_no_pergi', 'flight_no_balik', 'passport_no', 'ic_no','destinasi_pergi', 'destinasi_balik', 'catatan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_kemudahan_ticket_kapal_terbang_pegawai_id' => 'Permohonan Kemudahan Ticket Kapal Terbang Pegawai ID',
            'permohonan_kemudahan_ticket_kapal_terbang_id' => 'Permohonan Kemudahan Ticket Kapal Terbang ID',
            'pegawai' => GeneralLabel::pegawai,
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
}
