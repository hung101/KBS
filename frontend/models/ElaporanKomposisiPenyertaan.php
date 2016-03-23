<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['elaporan_pelaksaan_id', 'kumpulan_penyertaan', 'jenis_komposisi', 'bilangan'], 'required', 'skipOnEmpty' => true],
            [['elaporan_pelaksaan_id', 'bilangan'], 'integer'],
            [['kumpulan_penyertaan'], 'string', 'max' => 80],
            [['jenis_komposisi'], 'string', 'max' => 30]
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
