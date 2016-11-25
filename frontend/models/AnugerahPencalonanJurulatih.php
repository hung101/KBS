<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_jurulatih".
 *
 * @property integer $anugerah_pencalonan_jurulatih_id
 * @property integer $kategori
 * @property string $sukan
 * @property string $nama_jurulatih
 * @property string $no_kad_pengenalan
 * @property string $no_telefon_1
 * @property string $no_telefon_2
 * @property integer $sijil_kejurulatihan_spesifik
 * @property string $ulasan_pencapaian
 * @property integer $kelulusan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori', 'sukan', 'nama_jurulatih', 'no_kad_pengenalan', 'no_telefon_1', 'no_telefon_2', 'sijil_kejurulatihan_spesifik'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['sijil_kejurulatihan_spesifik', 'kelulusan', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['sukan', 'nama_jurulatih'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_telefon_1', 'no_telefon_2'], 'string', 'max' => 14],
            [['no_telefon_1', 'no_telefon_2'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],            
            [['ulasan_pencapaian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_jurulatih_id' => 'Anugerah Pencalonan Jurulatih ID',
            'kategori' => 'Kategori',
            'sukan' => 'Sukan',
            'nama_jurulatih' => 'Nama Jurulatih',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'no_telefon_1' => 'No Telefon 1',
            'no_telefon_2' => 'No Telefon 2',
            'sijil_kejurulatihan_spesifik' => 'Sijil Kejurulatihan Spesifik (Tahap)',
            'ulasan_pencapaian' => 'Ulasan Pencapaian',
            'kelulusan' => 'Kelulusan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPencalonanJurulatih(){
        return $this->hasOne(RefKategoriPencalonanJurulatih::className(), ['id' => 'kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
}
