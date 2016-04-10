<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_karier".
 *
 * @property integer $karier_atlet_id
 * @property string $atlet_id
 * @property string $syarikat
 * @property string $alamat
 * @property string $laman_web
 * @property integer $tel_no
 * @property string $emel
 * @property string $jawatan_kerja
 * @property string $pendapatan
 * @property string $tahun_mula
 * @property string $tahun_tamat
 * @property string $socso_no
 * @property string $kwsp_no
 * @property string $income_tax_no
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AtletKarier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_karier';
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
            [['atlet_id', 'syarikat', 'jawatan_kerja', 'pendapatan', 'tahun_mula', 'tahun_tamat', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tel_no'], 'required', 'skipOnEmpty' => true],
            [['tel_no', 'created_by', 'updated_by'], 'integer'],
            [['pendapatan'], 'number'],
            [['tahun_mula', 'tahun_tamat', 'created', 'updated'], 'safe'],
            [['atlet_id', 'socso_no', 'income_tax_no'], 'string', 'max' => 20],
            [['syarikat', 'emel'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['laman_web'], 'string', 'max' => 120],
            [['jawatan_kerja', 'alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['kwsp_no'], 'string', 'max' => 10],
            [['alamat_poskod'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'karier_atlet_id' => GeneralLabel::karier_atlet_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'syarikat' => GeneralLabel::syarikat,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'laman_web' => GeneralLabel::laman_web,
            'tel_no' => GeneralLabel::tel_no,
            'faks_no' => GeneralLabel::faks_no,
            'emel' => GeneralLabel::emel,
            'jawatan_kerja' => GeneralLabel::jawatan_kerja,
            'pendapatan' => GeneralLabel::pendapatan,
            'tahun_mula' => GeneralLabel::tahun_mula,
            'tahun_tamat' => GeneralLabel::tahun_tamat,
            'socso_no' => GeneralLabel::socso_no,
            'kwsp_no' => GeneralLabel::kwsp_no,
            'income_tax_no' => GeneralLabel::income_tax_no,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
}
