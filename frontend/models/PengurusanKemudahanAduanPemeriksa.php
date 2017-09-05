<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_aduan_pemeriksa".
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
class PengurusanKemudahanAduanPemeriksa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_aduan_pemeriksa';
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
            [['pengurusan_kemudahan_venue_id', 'kategori_aduan', 'tarikh_aduan', 'nama_pengadu'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_kemudahan_venue_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_aduan'], 'safe'],
            [['kategori_aduan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['venue', 'peralatan', 'nama_pengadu'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kenyataan_aduan', 'tindakan_ulasan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_aduan','venue', 'peralatan', 'nama_pengadu','kenyataan_aduan', 'tindakan_ulasan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_aduan_pemeriksa_id' => GeneralLabel::pengurusan_kemudahan_aduan_pemeriksa_id,
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'kategori_aduan' => GeneralLabel::kategori_aduan,
            'venue' => GeneralLabel::venue,
            'peralatan' => GeneralLabel::peralatan,
            'tarikh_aduan' => GeneralLabel::tarikh_aduan,
            'nama_pengadu' => GeneralLabel::nama_pengadu,
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
