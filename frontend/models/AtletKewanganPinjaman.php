<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_kewangan_pinjaman".
 *
 * @property integer $pinjaman_id
 * @property integer $atlet_id
 * @property string $nama_bank
 * @property string $jenis_pinjaman
 * @property string $no_akaun
 * @property string $nilai_pinjaman
 * @property integer $tahun_tamat
 * @property string $tahun_permulaan
 */
class AtletKewanganPinjaman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_kewangan_pinjaman';
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
            [['atlet_id', 'nama_bank', 'jenis_pinjaman', 'nilai_pinjaman', 'tahun_tamat', 'tahun_permulaan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'tahun_tamat'], 'integer'],
            [['nilai_pinjaman'], 'number'],
            [['tahun_permulaan'], 'safe'],
            [['nama_bank'], 'string', 'max' => 100],
            [['jenis_pinjaman'], 'string', 'max' => 30],
            [['no_akaun'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pinjaman_id' => GeneralLabel::pinjaman_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_bank' => GeneralLabel::nama_bank,
            'jenis_pinjaman' => GeneralLabel::jenis_pinjaman,
            'no_akaun' => GeneralLabel::no_akaun,
            'nilai_pinjaman' => GeneralLabel::nilai_pinjaman,
            'tahun_permulaan' => GeneralLabel::tahun_permulaan,
            'tahun_tamat' => GeneralLabel::tahun_tamat,

        ];
    }
}
