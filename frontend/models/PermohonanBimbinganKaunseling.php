<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_bimbingan_kaunseling".
 *
 * @property integer $permohonan_bimbingan_kaunseling_id
 * @property integer $atlet_id
 * @property string $status_permohonan
 * @property string $tarikh_rujukan
 * @property string $nama_pemohon_rujukan
 * @property string $kes_latarbelakang
 * @property string $notis
 * @property string $pekerjaan_bapa
 * @property string $pekerjaan_ibu
 * @property integer $bil_adik_beradik
 * @property string $no_telefon
 */
class PermohonanBimbinganKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_bimbingan_kaunseling';
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
            [['atlet_id', 'tarikh_temujanji', 'nama_pemohon_rujukan', 'kes_latarbelakang'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'bil_adik_beradik'], 'integer'],
            [['tarikh_rujukan'], 'safe'],
            [['status_permohonan', 'kes_latarbelakang'], 'string', 'max' => 30],
            [['nama_pemohon_rujukan', 'pekerjaan_bapa', 'pekerjaan_ibu'], 'string', 'max' => 80],
            [['notis'], 'string', 'max' => 255],
            [['no_telefon'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_bimbingan_kaunseling_id' => 'Permohonan Bimbingan Kaunseling ID',
            'atlet_id' => 'Atlet',
            'tarikh_temujanji' => 'Tarikh Temujanji',
            'status_permohonan' => 'Status Permohonan',
            'tarikh_rujukan' => 'Tarikh Rujukan',
            'nama_pemohon_rujukan' => 'Nama Pemohon Rujukan',
            'kes_latarbelakang' => 'Latarbelakang Kes',
            'kes_latarbelakang_lain' => '',
            'notis' => 'Nota Kes',
            'pekerjaan_bapa' => 'Pekerjaan Bapa',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'bil_adik_beradik' => 'Bil Adik Beradik',
            'no_telefon' => 'No Telefon',
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
    public function getRefStatusPermohonan(){
        return $this->hasOne(RefStatusPermohonan::className(), ['id' => 'status_permohonan']);
    }
}
