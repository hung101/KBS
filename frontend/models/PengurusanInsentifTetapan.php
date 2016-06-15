<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_insentif_tetapan".
 *
 * @property integer $pengurusan_insentif_tetapan_id
 * @property string $sgar
 * @property string $sikap
 * @property string $siso_olimpik
 * @property string $siso_paralimpik
 * @property string $sito_emas
 * @property string $sito_perak
 * @property string $sito_gangsa
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanInsentifTetapan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insentif_tetapan';
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
            [['sgar', 'sikap', 'siso_olimpik', 'siso_paralimpik', 'sito_emas', 'sito_perak', 'sito_gangsa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['sgar', 'sikap', 'siso_olimpik', 'siso_paralimpik', 'sito_emas', 'sito_perak', 'sito_gangsa'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insentif_tetapan_id' => 'Pengurusan Insentif Tetapan ID',
            'sgar' => GeneralLabel::sgar_peratus,
            'sikap' => GeneralLabel::sikap_peratus,
            'siso_olimpik' => GeneralLabel::siso_olimpik,
            'siso_paralimpik' => GeneralLabel::siso_paralimpik,
            'sito_emas' => GeneralLabel::sito_emas,
            'sito_perak' => GeneralLabel::sito_perak,
            'sito_gangsa' => GeneralLabel::sito_gangsa,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
