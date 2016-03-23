<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ujian_saringan".
 *
 * @property integer $ujian_saringan_id
 * @property string $nama
 * @property string $sekolah
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $jantina
 * @property string $no_telefon
 * @property string $darjah
 * @property string $berat_badan
 * @property string $ketinggian
 * @property string $tinggi_duduk
 * @property string $panjang_depa
 * @property string $body_mass_index
 * @property string $catatan
 */
class UjianSaringan extends \yii\db\ActiveRecord
{
    //public $umur;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ujian_saringan';
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
            [['nama', 'sekolah', 'no_kad_pengenalan'], 'required', 'skipOnEmpty' => true],
            [['berat_badan', 'ketinggian', 'tinggi_duduk', 'panjang_depa', 'body_mass_index'], 'number'],
            [['nama', 'sekolah'], 'string', 'max' => 80],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'darjah'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['jantina'], 'string', 'max' => 1],
            [['no_telefon'], 'string', 'max' => 14],
            [['catatan'], 'string', 'max' => 255],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_kad_pengenalan'], 'integer'],
            [['umur'], 'integer'],
            [['bangsa', 'sukan', 'tarikh_lahir', 'maklumat_program'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ujian_saringan_id' => 'Ujian Saringan ID',
            'nama' => 'Nama',
            'sekolah' => 'Sekolah',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'jantina' => 'Jantina',
            'no_telefon' => 'No Telefon',
            'darjah' => 'Darjah',
            'berat_badan' => 'Berat Badan (kg)',
            'ketinggian' => 'Ketinggian (cm)',
            'tinggi_duduk' => 'Tinggi Duduk (cm)',
            'panjang_depa' => 'Panjang Depa (cm)',
            'body_mass_index' => 'Body Mass Index (m)',
            'catatan' => 'Catatan',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'umur' => 'Umur',
            'bangsa' => 'Bangsa',
            'sukan' => 'Sukan',
            'tarikh_lahir' => 'Tarikh Lahir',
            'maklumat_program' => 'Maklumat Program',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSekolah(){
        return $this->hasOne(RefSekolah::className(), ['id' => 'sekolah']);
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
