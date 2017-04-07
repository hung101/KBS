<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_venue".
 *
 * @property integer $pengurusan_kemudahan_venue_id
 * @property string $nama_venue
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_faks
 * @property string $pemilik
 * @property string $sewaan
 * @property string $status
 */
class PengurusanKemudahanVenueMsn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_venue_msn';
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
            [['nama_venue',  'pemilik', 'kategori_hakmilik', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_telefon', 'emel', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_venue', 'pemilik', 'sewaan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri', 'status'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tahun_pembinaan', 'tahun_siap_pembinaan', 'kategori_hakmilik', 'public_user_id', 'alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kos_project'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['keluasan_venue'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'nama_venue' => GeneralLabel::nama_venue,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_faks' => GeneralLabel::no_faks,
            'emel' => GeneralLabel::emel,
            'tahun_pembinaan' => GeneralLabel::tahun_pembinaan,
            'tahun_siap_pembinaan' => GeneralLabel::tahun_siap_pembinaan,
            'keluasan_venue' => GeneralLabel::keluasan_venue,
            'no_faks' => GeneralLabel::no_faks,
            'pemilik' => GeneralLabel::pemilik,
            'sewaan' => GeneralLabel::sewaan,
            'status' => GeneralLabel::status,
            'kos_project' => GeneralLabel::kos_project,
            'kategori_hakmilik' => GeneralLabel::kategori_hakmilik,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusVenue(){
        return $this->hasOne(RefStatusVenue::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriHakmilik(){
        return $this->hasOne(RefKategoriHakmilik::className(), ['id' => 'kategori_hakmilik']);
    }
    
    /* ActiveRelation */
    public function getRefNegeri()
    {
        return $this->hasOne(RefNegeri::className(), ['id' => 'alamat_negeri']);
    }
    
    /* ActiveRelation */
    public function getRefBandar()
    {
        return $this->hasOne(RefBandar::className(), ['id' => 'alamat_bandar']);
    }
    
    public function getNameAndState(){
        $returnValue = '(' . $this->refNegeri->desc . ' - ' . $this->refBandar->desc . ')  ' . $this->nama_venue;
        
        return $returnValue;
    }
}
