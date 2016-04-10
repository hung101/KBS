<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_kelayakan_sukan_spesifik_akk".
 *
 * @property integer $kelayakan_sukan_spesifik_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_kursus
 * @property string $tahap
 * @property string $tahun_lulus
 * @property string $persatuan_sukan
 */
class KelayakanSukanSpesifikAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kelayakan_sukan_spesifik_akk';
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
            [['nama_kursus', 'tahap', 'tahun_lulus', 'persatuan_sukan'], 'required', 'skipOnEmpty' => true],
            [['akademi_akk_id'], 'integer'],
            [['tahun_lulus'], 'safe'],
            [['nama_kursus', 'persatuan_sukan'], 'string', 'max' => 80],
            [['tahap'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kelayakan_sukan_spesifik_akk_id' => GeneralLabel::kelayakan_sukan_spesifik_akk_id,
            'akademi_akk_id' => GeneralLabel::akademi_akk_id,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tahap' => GeneralLabel::tahap,
            'tahun_lulus' => GeneralLabel::tahun_lulus,
            'persatuan_sukan' => GeneralLabel::persatuan_sukan,

        ];
    }
}
