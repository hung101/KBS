<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['atlet_id', 'kumpulan_darah'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['kumpulan_darah'], 'string', 'max' => 60],
            [['alergi_makanan', 'alergi_perubatan', 'alergi_jenis_lain', 'penyakit_semula_jadi'], 'string', 'max' => 255],
            [['penyakit_lain_lain'], 'safe'],
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

        ];
    }
}
