<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_paobs_penganjuran_sumber_kewangan".
 *
 * @property integer $paobs_penganjuran_sumber_kewangan_id
 * @property integer $penganjuran_id
 * @property string $sumber
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PaobsPenganjuranSumberKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_paobs_penganjuran_sumber_kewangan';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['sumber', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['sumber', 'session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paobs_penganjuran_sumber_kewangan_id' => GeneralLabel::paobs_penganjuran_sumber_kewangan_id,
            'penganjuran_id' => GeneralLabel::penganjuran_id,
            'sumber' => GeneralLabel::sumber,
            'jumlah' => GeneralLabel::jumlah,
            'session_id' => GeneralLabel::session_id,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
}
