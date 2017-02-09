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
            [['pegawai'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['pegawai'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
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
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
