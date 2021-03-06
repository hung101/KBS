<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penilaian_penganjur_kursus".
 *
 * @property integer $penilaian_peserta_terhadap_kursus_id
 * @property integer $pengurusan_permohonan_kursus_persatuan_id
 * @property string $tarikh_kursus
 * @property string $nama_penganjur_kursus
 * @property string $kod_kursus
 * @property string $tempat_kursus
 * @property string $nama_penyelaras
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenilaianPesertaTerhadapKursus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_peserta_terhadap_kursus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_permohonan_kursus_persatuan_id', 'nama_penganjur_kursus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_permohonan_kursus_persatuan_id', 'created_by', 'updated_by', 'tahap', 'lain_lain1', 'lain_lain2'], 'integer'],
            [['tarikh_kursus', 'created', 'updated', 'kelemahan', 'tarikh_tamat_kursus'], 'safe'],
            [['nama_penganjur_kursus', 'nama_penyelaras', 'nama_kursus'], 'string', 'max' => 80],
            [['kod_kursus'], 'string', 'max' => 30],
            [['tempat_kursus'], 'string', 'max' => 90],
            [['nama_penganjur_kursus', 'nama_penyelaras', 'nama_kursus','kod_kursus','tempat_kursus'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_peserta_terhadap_kursus_id' => 'Penilaian Penganjur Kursus ID',
            'pengurusan_permohonan_kursus_persatuan_id' => GeneralLabel::agensi,
            'tarikh_kursus' => GeneralLabel::tarikh_mula_kursus,
            'nama_penganjur_kursus' => GeneralLabel::nama_penganjur_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tempat_kursus' => GeneralLabel::tempat_kursus,
            'nama_penyelaras' => GeneralLabel::nama_penyelaras,
            'kelemahan' => GeneralLabel::testimonial_peserta,
			'tahap' => GeneralLabel::tahap,
			'nama_kursus' => GeneralLabel::nama_kursus,
			'tarikh_tamat_kursus' => GeneralLabel::tarikh_tamat_kursus,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanPermohonanKursusPersatuan(){
        return $this->hasOne(PengurusanPermohonanKursusPersatuan::className(), ['pengurusan_permohonan_kursus_persatuan_id' => 'pengurusan_permohonan_kursus_persatuan_id']);
    }
}
