<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_aduan".
 *
 * @property integer $pengurusan_kemudahan_aduan_id
 * @property integer $pengurusan_kemudahan_venue_id
 * @property string $kategori_aduan
 * @property string $venue
 * @property string $peralatan
 * @property string $tarikh_aduan
 * @property string $nama_pengadu
 * @property string $kenyataan_aduan
 * @property string $tindakan_ulasan
 */
class PengurusanKemudahanAduan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_aduan';
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
            [['pengurusan_kemudahan_venue_id', 'kategori_aduan', 'tarikh_aduan', 'nama_pengadu'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_kemudahan_venue_id'], 'integer'],
            [['tarikh_aduan'], 'safe'],
            [['kategori_aduan'], 'string', 'max' => 30],
            [['emel_pengadu'], 'string', 'max' => 100],
            [['emel_pengadu'], 'email'],
            [['tel_bimbit_pengadu'], 'string', 'max' => 14],
            [['tel_bimbit_pengadu'], 'integer'],
            [['venue', 'peralatan', 'nama_pengadu'], 'string', 'max' => 80],
            [['kenyataan_aduan', 'tindakan_ulasan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_aduan_id' => GeneralLabel::pengurusan_kemudahan_aduan_id,
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'kategori_aduan' => GeneralLabel::kategori_aduan,
            'venue' => GeneralLabel::venue,
            'peralatan' => GeneralLabel::peralatan,
            'tarikh_aduan' => GeneralLabel::tarikh_aduan,
            'nama_pengadu' => GeneralLabel::nama_pengadu,
            'emel_pengadu' => GeneralLabel::emel_pengadu,
            'tel_bimbit_pengadu' => GeneralLabel::tel_bimbit_pengadu,
            'kenyataan_aduan' => GeneralLabel::kenyataan_aduan,
            'tindakan_ulasan' => GeneralLabel::tindakan_ulasan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanVenue(){
        return $this->hasOne(PengurusanKemudahanVenue::className(), ['pengurusan_kemudahan_venue_id' => 'pengurusan_kemudahan_venue_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriAduanKemudahan(){
        return $this->hasOne(RefKategoriAduanKemudahan::className(), ['id' => 'kategori_aduan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanKemudahan(){
        return $this->hasOne(RefPeralatanKemudahan::className(), ['id' => 'peralatan']);
    }
}
