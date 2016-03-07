<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_mesyuarat".
 *
 * @property integer $mesyuarat_id
 * @property string $bil_mesyuarat
 * @property string $tarikh
 * @property string $masa
 * @property string $tempat
 * @property string $pengurusi
 * @property string $pencatat_minit
 * @property string $perkara_perkara_dan_tindakan
 * @property string $mesyuarat_tamat
 * @property string $mesyuarat_seterusnya
 * @property string $disedia_oleh
 * @property string $disemak_oleh
 */
class Mesyuarat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mesyuarat';
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
            [['bil_mesyuarat', 'nama_mesyuarat', 'agenda', 'tarikh', 'tempat', 'disedia_oleh', 'disemak_oleh'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['bil_mesyuarat', 'tempat'], 'string', 'max' => 20],
            [['pengurusi', 'pencatat_minit', 'perkara_perkara_dan_tindakan'], 'string', 'max' => 255],
            [['mesyuarat_tamat', 'mesyuarat_seterusnya', 'disedia_oleh', 'disemak_oleh'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mesyuarat_id' => 'Mesyuarat ID',
            'nama_mesyuarat' => 'Nama Mesyuarat',
            'agenda' => 'Agenda',
            'bil_mesyuarat' => 'Bil Mesyuarat',
            'tarikh' => 'Tarikh & Masa',
            'masa' => 'Masa',
            'tempat' => 'Tempat',
            'pengurusi' => 'Pengurusi',
            'pencatat_minit' => 'Pencatat Minit',
            'perkara_perkara_dan_tindakan' => 'Perkara Perkara Dan Tindakan',
            'mesyuarat_tamat' => 'Mesyuarat Tamat',
            'mesyuarat_seterusnya' => 'Mesyuarat Seterusnya',
            'muat_naik' => 'Muat Naik',
            'disedia_oleh' => 'Disedia Oleh',
            'disemak_oleh' => 'Disemak Oleh',
        ];
    }
}
