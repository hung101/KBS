<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_jurulatih_kesihatan".
 *
 * @property integer $jurulatih_kesihatan_id
 * @property integer $jurulatih_id
 * @property string $tinggi
 * @property string $berat
 * @property string $masalah_kesihatan
 * @property string $catatan
 * @property string $pembedahan
 * @property string $alahan
 * @property string $sejarah_perubatan
 * @property string $kecacatan
 */
class JurulatihKesihatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_kesihatan';
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
            [['jurulatih_id', 'tinggi', 'berat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tinggi', 'berat'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['masalah_kesihatan', 'catatan', 'pembedahan', 'alahan', 'sejarah_perubatan', 'kecacatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['masalah_kesihatan', 'catatan', 'pembedahan', 'alahan', 'sejarah_perubatan', 'kecacatan'], function ($attribute, $params) {
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
            'jurulatih_kesihatan_id' => GeneralLabel::jurulatih_kesihatan_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'tinggi' => GeneralLabel::tinggi,
            'berat' => GeneralLabel::berat,
            'masalah_kesihatan' => GeneralLabel::masalah_kesihatan,
            'catatan' => GeneralLabel::penyakit_penyakit_lain,
            'pembedahan' => GeneralLabel::pembedahan,
            'alahan' => GeneralLabel::alahan,
            'sejarah_perubatan' => GeneralLabel::sejarah_perubatan,
            'kecacatan' => GeneralLabel::kecacatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefMasalahKesihatan(){
        return $this->hasOne(RefMasalahKesihatan::className(), ['id' => 'masalah_kesihatan']);
    }
}
