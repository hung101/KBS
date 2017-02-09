<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_kemudahan_ticket_kapal_terbang_sukan".
 *
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_sukan_id
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_id
 * @property integer $sukan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanKemudahanTicketKapalTerbangSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_kemudahan_ticket_kapal_terbang_sukan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_kemudahan_ticket_kapal_terbang_id', 'sukan', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required ],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_kemudahan_ticket_kapal_terbang_sukan_id' => 'Permohonan Kemudahan Ticket Kapal Terbang Sukan ID',
            'permohonan_kemudahan_ticket_kapal_terbang_id' => 'Permohonan Kemudahan Ticket Kapal Terbang ID',
            'sukan' => GeneralLabel::sukan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
