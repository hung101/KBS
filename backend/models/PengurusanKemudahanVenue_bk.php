<?php

namespace app\models;

use Yii;

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
class PengurusanKemudahanVenue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_venue';
    }
    
    public function behaviors()
    {
        return [
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
            [['nama_venue',  'pemilik', 'kategori_hakmilik', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'emel', 'status'], 'required', 'skipOnEmpty' => true],
            [['nama_venue', 'pemilik', 'sewaan'], 'string', 'max' => 80],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['tahun_pembinaan', 'tahun_siap_pembinaan', 'kategori_hakmilik', 'public_user_id', 'status'], 'integer'],
            [['kos_project', 'bayaran_sewa'], 'number'],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['keluasan_venue'], 'string', 'max' => 50],
            [['emel'], 'string', 'max' => 100],
            [['emel'], 'email'],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_venue_id' => 'Pengurusan Kemudahan Venue ID',
            'nama_venue' => 'Nama Venue',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_telefon' => 'No Telefon',
            'no_faks' => 'No Faks',
            'emel' => 'Emel',
            'tahun_pembinaan' => 'Tahun Pembinaan',
            'tahun_siap_pembinaan' => 'Tahun Siap Pembinaan',
            'keluasan_venue' => 'Keluasan Venue',
            'no_faks' => 'No Faks',
            'pemilik' => 'Pemilik',
            'sewaan' => 'Sewaan',
            'bayaran_sewa'=> 'Bayaran Sewa',
            'status' => 'Status',
            'kos_project' => 'Kos Projek',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusVenue(){
        return $this->hasOne(RefStatusVenue::className(), ['id' => 'status']);
    }
}
