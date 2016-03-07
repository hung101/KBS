<?php

namespace app\models;

use Yii;

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
            [['sukan', 'tarikh_mula', 'tarikh_akhir', 'kejohanan_mewakili', 'acara', 'nama_kejohanan', 'tempat', 'pencapaian'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_biasiswa_id'], 'integer'],
            [['tarikh_mula', 'tarikh_akhir'], 'safe'],
            [['sukan', 'anjuran', 'acara', 'nama_kejohanan'], 'string', 'max' => 80],
            [['kejohanan_mewakili', 'pencapaian'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyertaan_kejohanan_id' => 'Penyertaan Kejohanan ID',
            'permohonan_e_biasiswa_id' => 'Permohonan E Biasiswa ID',
            'sukan' => 'Sukan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_akhir' => 'Tarikh Akhir',
            'anjuran' => 'Anjuran',
            'kejohanan_mewakili' => 'Peringkat Kejohanan',
            'acara' => 'Acara',
            'nama_kejohanan' => 'Nama Kejohanan',
            'tempat' => 'Tempat',
            'pencapaian' => 'Pencapaian',
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
