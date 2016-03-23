<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ltbs_ahli_jawatankuasa_induk_kecil".
 *
 * @property integer $ahli_jawatan_id
 * @property string $jenis_jawatankuasa
 * @property string $nama_jawatankuasa
 * @property string $jawatan
 * @property string $nama_penuh
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $bangsa
 * @property integer $umur
 * @property string $pekerjaan
 * @property string $nama_majikan
 * @property string $tarikh_mula_memegang_jawatan
 * @property string $pengiktirafan_yang_diterima
 * @property string $kursus_yang_pernah_diikuti_oleh_pemegang_jawatan
 */
class LtbsAhliJawatankuasaIndukKecil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_ahli_jawatankuasa_induk_kecil';
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
            [['jenis_jawatankuasa', 'nama_majikan'], 'string', 'max' => 30],
            [['nama_jawatankuasa', 'jawatan', 'pekerjaan'], 'string', 'max' => 50],
            [['nama_penuh', 'pengiktirafan_yang_diterima', 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['bangsa'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ahli_jawatan_id' => GeneralLabel::ahli_jawatan_id,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'jenis_jawatankuasa' => GeneralLabel::jenis_jawatankuasa,
            'nama_jawatankuasa' => GeneralLabel::nama_jawatankuasa,
            'jawatan' => GeneralLabel::jawatan,
            'nama_penuh' => GeneralLabel::nama_penuh,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'jantina' => GeneralLabel::jantina,
            'bangsa' => GeneralLabel::bangsa,
            'umur' => GeneralLabel::umur,
            'no_tel' => GeneralLabel::no_tel,
            'emel' => GeneralLabel::emel,
            'pekerjaan' => GeneralLabel::pekerjaan,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'tarikh_mula_memegang_jawatan' => GeneralLabel::tarikh_mula_memegang_jawatan,
            'pengiktirafan_yang_diterima' => GeneralLabel::pengiktirafan_yang_diterima,
            'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan' => GeneralLabel::kursus_yang_pernah_diikuti_oleh_pemegang_jawatan,
            'status' => GeneralLabel::status,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanInduk(){
        return $this->hasOne(RefJawatanInduk::className(), ['id' => 'jawatan']);
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
