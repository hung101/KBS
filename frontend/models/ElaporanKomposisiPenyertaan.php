<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_komposisi_penyertaan".
 *
 * @property integer $elaporan_komposisi_penyertaan_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $kumpulan_penyertaan
 * @property string $jenis_komposisi
 * @property integer $bilangan
 */
class ElaporanKomposisiPenyertaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_komposisi_penyertaan';
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
            [['elaporan_pelaksaan_id', 'kumpulan_penyertaan', 'jenis_komposisi', 'bilangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['elaporan_pelaksaan_id', 'bilangan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kumpulan_penyertaan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_komposisi'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kumpulan_penyertaan','jenis_komposisi'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_komposisi_penyertaan_id' => GeneralLabel::elaporan_komposisi_penyertaan_id,
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'kumpulan_penyertaan' => GeneralLabel::kumpulan_penyertaan,
            'jenis_komposisi' => GeneralLabel::jenis_komposisi,
            'bilangan' => GeneralLabel::bilangan,

        ];
    }
}
