<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penilaian_penganjur_kursus_soalan".
 *
 * @property integer $penilaian_peserta_terhadap_kursus_soalan_id
 * @property integer $penilaian_peserta_terhadap_kursus_id
 * @property integer $kategori_soalan
 * @property integer $soalan
 * @property integer $skala
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenilaianPesertaTerhadapKursusSoalan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_peserta_terhadap_kursus_soalan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_soalan', 'soalan', 'skala'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['penilaian_peserta_terhadap_kursus_id', 'kategori_soalan', 'soalan', 'skala', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_peserta_terhadap_kursus_soalan_id' => 'Penilaian Peserta Kursus Soalan ID',
            'penilaian_peserta_terhadap_kursus_id' => 'Penilaian Peserta Kursus ID',
            'kategori_soalan' => GeneralLabel::kategori_soalan,
            'soalan' => GeneralLabel::soalan,
            'skala' => GeneralLabel::skala,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriSoalanPeserta(){
        return $this->hasOne(RefKategoriSoalanPeserta::className(), ['id' => 'kategori_soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanPeserta(){
        return $this->hasOne(RefSoalanPeserta::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRatingSoalan(){
        return $this->hasOne(RefRatingSoalan::className(), ['id' => 'skala']);
    }
}
