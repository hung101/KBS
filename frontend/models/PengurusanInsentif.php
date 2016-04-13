<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            [['atlet_id', 'nama_insentif', 'kumpulan', 'rekod_baru', 'nama_sukan', 'kelayakan_pingat', 'jumlah_insentif', 'sgar_nama_jurulatih', 'category_insentif', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_insentif', 'jumlah_sgar', 'jumlah_sikap', 'jumlah_siso', 'jumlah_sito'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['siso_tarikh_kelayakan', 'sisi_tarikh_olimpik'], 'safe'],
            [['nama_insentif', 'nama_sukan', 'sgar_nama_jurulatih', 'sikap_nama_persatuan', 'sito_nama_acara_di_olimpik'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kumpulan', 'rekod_baru', 'kelayakan_pingat', 'sito_pingat', 'category_insentif'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insentif_id' => GeneralLabel::pengurusan_insentif_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_insentif' => GeneralLabel::nama_insentif,
            'kumpulan' => GeneralLabel::kumpulan,
            'rekod_baru' => GeneralLabel::rekod_baru,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'kelayakan_pingat' => GeneralLabel::kelayakan_pingat,
            'jumlah_insentif' => GeneralLabel::jumlah_insentif,
            'sgar_nama_jurulatih' => GeneralLabel::sgar_nama_jurulatih,
            'jumlah_sgar' => GeneralLabel::jumlah_sgar,
            'sikap_nama_persatuan' => GeneralLabel::sikap_nama_persatuan,
            'jumlah_sikap' => GeneralLabel::jumlah_sikap,
            'siso_tarikh_kelayakan' => GeneralLabel::siso_tarikh_kelayakan,
            'sisi_tarikh_olimpik' => GeneralLabel::sisi_tarikh_olimpik,
            'jumlah_siso' => GeneralLabel::jumlah_siso,
            'sito_nama_acara_di_olimpik' => GeneralLabel::sito_nama_acara_di_olimpik,
            'sito_pingat' => GeneralLabel::sito_pingat,
            'jumlah_sito' => GeneralLabel::jumlah_sito,
            'category_insentif' => GeneralLabel::category_insentif,
            'muat_naik_dokumen' => GeneralLabel::muat_naik_dokumen,
            'kelulusan' => GeneralLabel::kelulusan,

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
