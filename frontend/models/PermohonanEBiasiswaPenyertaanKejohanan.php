<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_biasiswa_penyertaan_kejohanan".
 *
 * @property integer $penyertaan_kejohanan_id
 * @property integer $permohonan_e_biasiswa_id
 * @property string $sukan
 * @property string $tarikh_mula
 * @property string $anjuran
 * @property string $kejohanan_mewakili
 * @property string $acara
 * @property string $nama_kejohanan
 * @property string $tempat
 * @property string $pencapaian
 */
class PermohonanEBiasiswaPenyertaanKejohanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_biasiswa_penyertaan_kejohanan';
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
            [['sukan', 'tarikh_mula', 'tarikh_akhir', 'kejohanan_mewakili', 'acara', 'nama_kejohanan', 'tempat', 'pencapaian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_e_biasiswa_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'tarikh_akhir'], 'safe'],
            [['sukan', 'anjuran', 'acara', 'nama_kejohanan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejohanan_mewakili', 'pencapaian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'anjuran', 'acara', 'nama_kejohanan','kejohanan_mewakili', 'pencapaian','tempat'], function ($attribute, $params) {
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
            'penyertaan_kejohanan_id' => GeneralLabel::penyertaan_kejohanan_id,
            'permohonan_e_biasiswa_id' => GeneralLabel::permohonan_e_biasiswa_id,
            'sukan' => GeneralLabel::sukan,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_akhir' => GeneralLabel::tarikh_akhir,
            'anjuran' => GeneralLabel::anjuran,
            'kejohanan_mewakili' => GeneralLabel::kejohanan_mewakili,
            'acara' => GeneralLabel::acara,
            'nama_kejohanan' => GeneralLabel::nama_kejohanan,
            'tempat' => GeneralLabel::tempat,
            'pencapaian' => GeneralLabel::pencapaian,

        ];
    }
    
    public function getRefKejohananDiwakili()
    {
        return $this->hasOne(RefKejohananDiwakili::className(), ['id' => 'kejohanan_mewakili']);
    }
    
    public function getRefKejohananPencapaian()
    {
        return $this->hasOne(RefKejohananPencapaian::className(), ['id' => 'pencapaian']);
    }
    
    public function getRefAcara()
    {
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
