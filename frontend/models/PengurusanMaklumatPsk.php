<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_maklumat_psk".
 *
 * @property integer $pengurusan_maklumat_psk_id
 * @property string $nama_sponsor
 * @property integer $jumlah_sponsor
 * @property string $tarikh_sponsor_mula
 * @property string $tarikh_sponsor_tamat
 */
class PengurusanMaklumatPsk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_maklumat_psk';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_sponsor', 'jumlah_sponsor', 'tarikh_sponsor_mula', 'tarikh_sponsor_tamat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah_sponsor'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_sponsor_mula', 'tarikh_sponsor_tamat'], 'safe'],
            [['nama_sponsor'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_sponsor'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_maklumat_psk_id' => GeneralLabel::pengurusan_maklumat_psk_id,
            'nama_sponsor' => GeneralLabel::nama_sponsor,
            'jumlah_sponsor' => GeneralLabel::jumlah_sponsor,
            'tarikh_sponsor_mula' => GeneralLabel::tarikh_sponsor_mula,
            'tarikh_sponsor_tamat' => GeneralLabel::tarikh_sponsor_tamat,

        ];
    }
}
