<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_maklumat_kongres_di_luar_negara".
 *
 * @property integer $maklumat_kongres_di_luar_negara_id
 * @property integer $pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id
 * @property string $tajuk
 * @property string $tempat
 * @property string $masa
 * @property string $tarikh_penerbangan
 * @property string $tiket_penerbangan
 * @property string $jumlah_penerbangan
 * @property string $lain_lain
 * @property string $jumlah_kos_lain_lain
 * @property string $nama_pegawai_terlibat
 */
class MaklumatKongresDiLuarNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_kongres_di_luar_negara';
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
            [['pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id', 'tajuk', 'tempat', 'masa', 'tarikh_penerbangan', 'tiket_penerbangan', 'jumlah_penerbangan', 'nama_pegawai_terlibat'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id'], 'integer'],
            [['masa', 'tarikh_penerbangan'], 'safe'],
            [['jumlah_penerbangan', 'lain_lain', 'jumlah_kos_lain_lain'], 'number'],
            [['tajuk', 'nama_pegawai_terlibat'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90],
            [['tiket_penerbangan'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maklumat_kongres_di_luar_negara_id' => 'Maklumat Kongres Di Luar Negara ID',
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id' => 'Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat ID',
            'tajuk' => 'Tajuk',
            'tempat' => 'Tempat',
            'masa' => 'Masa',
            'tarikh_penerbangan' => 'Tarikh Penerbangan',
            'tiket_penerbangan' => 'Tiket Penerbangan',
            'jumlah_penerbangan' => 'Jumlah Penerbangan',
            'lain_lain' => 'Lain Lain',
            'jumlah_kos_lain_lain' => 'Jumlah Kos Lain Lain',
            'nama_pegawai_terlibat' => 'Nama Pegawai Terlibat',
        ];
    }
}
