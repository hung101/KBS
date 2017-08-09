<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_perubatan".
 *
 * @property integer $perubatan_id
 * @property integer $atlet_id
 * @property string $kumpulan_darah
 * @property string $alergi_makanan
 * @property string $alergi_perubatan
 * @property string $alergi_jenis_lain
 * @property string $penyakit_semula_jadi
 */
class AtletPerubatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan';
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
            [['atlet_id', 'kumpulan_darah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'staf_perubatan_yang_bertanggungjawab'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kumpulan_darah'], 'string', 'max' => 60, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alergi_makanan', 'alergi_perubatan', 'alergi_jenis_lain', 'penyakit_semula_jadi'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['penyakit_lain_lain'], 'safe'],
            [['kumpulan_darah','penyakit_lain_lain','alergi_makanan', 'alergi_perubatan', 'alergi_jenis_lain', 'penyakit_semula_jadi'], 'filter', 'filter' => function ($value) {
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
            'perubatan_id' => GeneralLabel::perubatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'kumpulan_darah' => GeneralLabel::kumpulan_darah,
            'alergi_makanan' => GeneralLabel::alergi_makanan,
            'alergi_perubatan' => GeneralLabel::alergi_perubatan,
            'alergi_jenis_lain' => GeneralLabel::alergi_jenis_lain,
            'penyakit_semula_jadi' => GeneralLabel::penyakit_semula_jadi,
            'penyakit_lain_lain' => GeneralLabel::penyakit_lain_lain,
            'staf_perubatan_yang_bertanggungjawab' => GeneralLabel::staf_perubatan_yang_bertanggungjawab,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKumpulanDarah(){
        return $this->hasOne(RefKumpulanDarah::className(), ['id' => 'kumpulan_darah']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStafPerubatanYangBertanggungjawab(){
        return $this->hasOne(RefStafPerubatanYangBertanggungjawab::className(), ['id' => 'staf_perubatan_yang_bertanggungjawab']);
    }
}
