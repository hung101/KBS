<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_latihan_dan_program_peserta".
 *
 * @property integer $latihan_dan_program_peserta_id
 * @property integer $latihan_dan_program_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $nama_badan_sukan
 * @property string $no_pendaftaran_sukan
 * @property string $jawatan
 * @property string $tempoh_memegang_jawatan
 * @property string $no_tel_bimbit
 * @property string $emel
 */
class LatihanDanProgramPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_latihan_dan_program_peserta';
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
            [['nama', 'no_kad_pengenalan', 'nama_badan_sukan', 'no_pendaftaran_sukan', 'jawatan', 'tempoh_memegang_jawatan', 'no_tel_bimbit'], 'required', 'skipOnEmpty' => true],
            [['latihan_dan_program_id', 'ahli_jawatan_induk_id', 'ahli_jawatan_kecil_id'], 'integer'],
            [['nama', 'nama_badan_sukan', 'jawatan', 'tempoh_memegang_jawatan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_pendaftaran_sukan'], 'string', 'max' => 30],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['emel'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'latihan_dan_program_peserta_id' => 'Latihan Dan Program Peserta ID',
            'latihan_dan_program_id' => 'Latihan Dan Program ID',
            'ahli_jawatan_induk_id' => 'Ahli Jawatankuasa Induk',
            'ahli_jawatan_kecil_id' => 'Ahli Jawatankuasa Kecil / Biro',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'nama_badan_sukan' => 'Nama Badan Sukan',
            'no_pendaftaran_sukan' => 'No Pendaftaran Sukan',
            'jawatan' => 'Jawatan',
            'tempoh_memegang_jawatan' => 'Tempoh Memegang Jawatan',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'emel' => 'Emel',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'nama_badan_sukan']);
    }
}
