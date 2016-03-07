<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ltbs_ahli_jawatankuasa_kecil".
 *
 * @property integer $ahli_jawatan_id
 * @property string $nama_jawatankuasa
 * @property string $jawatan
 * @property string $nama_penuh
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $bangsa
 * @property integer $umur
 * @property string $no_tel
 * @property string $emel
 * @property string $pekerjaan
 * @property string $nama_majikan
 * @property string $tarikh_mula_memegang_jawatan
 * @property string $pengiktirafan_yang_diterima
 * @property string $kursus_yang_pernah_diikuti_oleh_pemegang_jawatan
 */
class LtbsAhliJawatankuasaKecil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_ahli_jawatankuasa_kecil';
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
            [['jawatan', 'nama_penuh', 'no_kad_pengenalan', 'jantina', 'bangsa', 'umur', 'no_tel', 'tarikh_mula_memegang_jawatan', 'status'], 'required', 'skipOnEmpty' => true],
            [['umur', 'profil_badan_sukan_id', 'status'], 'integer'],
            [['emel'], 'email'],
            [['tarikh_mula_memegang_jawatan'], 'safe'],
            [['nama_jawatankuasa'], 'string', 'max' => 80],
            [['jawatan', 'pekerjaan'], 'string', 'max' => 50],
            [['nama_penuh', 'emel', 'pengiktirafan_yang_diterima', 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['bangsa'], 'string', 'max' => 25],
            [['no_tel'], 'string', 'max' => 14],
            [['nama_majikan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ahli_jawatan_id' => 'Ahli Jawatan ID',
            'profil_badan_sukan_id' => 'Badan Sukan',
            'nama_jawatankuasa' => 'Nama Jawatankuasa',
            'jawatan' => 'Jawatan',
            'nama_penuh' => 'Nama Penuh',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'jantina' => 'Jantina',
            'bangsa' => 'Bangsa',
            'umur' => 'Umur',
            'no_tel' => 'No Tel',
            'emel' => 'Emel',
            'pekerjaan' => 'Pekerjaan',
            'nama_majikan' => 'Nama Majikan',
            'tarikh_mula_memegang_jawatan' => 'Tarikh Mula Memegang Jawatan',
            'pengiktirafan_yang_diterima' => 'Pengiktirafan Yang Diterima',
            'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan' => 'Kursus Yang Pernah Diikuti Oleh Pemegang Jawatan',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatan(){
        return $this->hasOne(RefJawatan::className(), ['id' => 'jawatan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'profil_badan_sukan_id']);
    }
}
