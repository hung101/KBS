<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_pencapaian".
 *
 * @property integer $pencapaian_id
 * @property integer $atlet_id
 * @property string $nama_kejohanan_temasya
 * @property string $peringkat_kejohanan
 * @property string $tarikh_mula_kejohanan
 * @property string $tarikh_tamat_kejohanan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $lokasi_kejohanan
 * @property integer $insentif_id
 */
class AtletPencapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian';
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
            [['atlet_id', 'nama_kejohanan_temasya', 'peringkat_kejohanan', 'tarikh_mula_kejohanan', 'tarikh_tamat_kejohanan', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 'pencapaian'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'insentif_id'], 'integer'],
            [['tarikh_mula_kejohanan', 'tarikh_tamat_kejohanan'], 'safe'],
            [['nama_kejohanan_temasya'], 'string', 'max' => 80],
            [['peringkat_kejohanan', 'nama_sukan'], 'string', 'max' => 30],
            [['nama_acara'], 'string', 'max' => 100],
            [['lokasi_kejohanan'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pencapaian_id' => GeneralLabel::pencapaian_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_kejohanan_temasya' => GeneralLabel::nama_kejohanan_temasya,
            'peringkat_kejohanan' => GeneralLabel::peringkat_kejohanan,
            'tarikh_mula_kejohanan' => GeneralLabel::tarikh_mula_kejohanan,
            'tarikh_tamat_kejohanan' => GeneralLabel::tarikh_tamat_kejohanan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'lokasi_kejohanan' => GeneralLabel::lokasi_kejohanan,
            'pencapaian' => GeneralLabel::pencapaian,
            'insentif_id' => GeneralLabel::insentif_id,

        ];
    }
}
