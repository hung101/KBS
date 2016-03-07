<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_insentif".
 *
 * @property integer $pengurusan_insentif_id
 * @property integer $atlet_id
 * @property string $nama_insentif
 * @property string $kumpulan
 * @property string $rekod_baru
 * @property string $nama_sukan
 * @property string $kelayakan_pingat
 * @property string $jumlah_insentif
 * @property string $sgar_nama_jurulatih
 * @property string $jumlah_sgar
 * @property string $sikap_nama_persatuan
 * @property string $jumlah_sikap
 * @property string $siso_tarikh_kelayakan
 * @property string $sisi_tarikh_olimpik
 * @property string $jumlah_siso
 * @property string $sito_nama_acara_di_olimpik
 * @property string $sito_pingat
 * @property string $jumlah_sito
 * @property string $category_insentif
 * @property integer $kelulusan
 */
class PengurusanInsentif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insentif';
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
            [['atlet_id', 'nama_insentif', 'kumpulan', 'rekod_baru', 'nama_sukan', 'kelayakan_pingat', 'jumlah_insentif', 'sgar_nama_jurulatih', 'category_insentif', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['jumlah_insentif', 'jumlah_sgar', 'jumlah_sikap', 'jumlah_siso', 'jumlah_sito'], 'number'],
            [['siso_tarikh_kelayakan', 'sisi_tarikh_olimpik'], 'safe'],
            [['nama_insentif', 'nama_sukan', 'sgar_nama_jurulatih', 'sikap_nama_persatuan', 'sito_nama_acara_di_olimpik'], 'string', 'max' => 80],
            [['kumpulan', 'rekod_baru', 'kelayakan_pingat', 'sito_pingat', 'category_insentif'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insentif_id' => 'Pengurusan Insentif ID',
            'atlet_id' => 'Atlet',
            'nama_insentif' => 'Nama Insentif',
            'kumpulan' => 'Kumpulan',
            'rekod_baru' => 'Rekod Baru',
            'nama_sukan' => 'Nama Sukan',
            'kelayakan_pingat' => 'Kelayakan Pingat',
            'jumlah_insentif' => 'Jumlah Insentif',
            'sgar_nama_jurulatih' => 'SGAR Nama Jurulatih',
            'jumlah_sgar' => 'Jumlah SGAR',
            'sikap_nama_persatuan' => 'SIKAP Nama Persatuan',
            'jumlah_sikap' => 'Jumlah SIKAP',
            'siso_tarikh_kelayakan' => 'SISO Tarikh Kelayakan',
            'sisi_tarikh_olimpik' => 'SISO Tarikh Olimpik',
            'jumlah_siso' => 'Jumlah SISO',
            'sito_nama_acara_di_olimpik' => 'SITO Nama Acara Di Olimpik',
            'sito_pingat' => 'SITO Pingat',
            'jumlah_sito' => 'Jumlah SITO',
            'category_insentif' => 'Kategory Insentif',
            'muat_naik_dokumen' => 'Muat Naik Dokumen',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNamaInsentif(){
        return $this->hasOne(RefNamaInsentif::className(), ['id' => 'nama_insentif']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKumpulan(){
        return $this->hasOne(RefKumpulan::className(), ['id' => 'kumpulan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRekodBaru(){
        return $this->hasOne(RefRekodBaru::className(), ['id' => 'rekod_baru']);
    }
}
