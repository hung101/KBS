<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_geran_bantuan_gaji".
 *
 * @property integer $geran_bantuan_gaji_id
 * @property string $muatnaik_gambar
 * @property string $nama_jurulatih
 * @property string $cawangan
 * @property string $sub_cawangan
 * @property string $program_msn
 * @property string $lain_lain_program
 * @property string $pusat_latihan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $status_jurulatih
 * @property string $status_permohonan
 * @property string $status_keaktifan_jurulatih
 * @property string $kategori_geran
 * @property string $jumlah_geran
 * @property string $status_geran
 * @property integer $kelulusan
 * @property string $catatan
 */
class GeranBantuanGaji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_geran_bantuan_gaji';
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
            [['nama_jurulatih', 'tarikh_mula', 'tarikh_tamat', 'status_permohonan', 'kategori_geran', 'jumlah_geran', 'status_geran', 'kelulusan',
                'tarikh_mula_kontrak', 'tarikh_tamat_kontrak', 'agensi' ], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula_kontrak', 'tarikh_tamat_kontrak', 'tarikh_cek'], 'safe'],
            [['jumlah_geran', 'kadar'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [[ 'bulan', 'nama_acara', 'nama_sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['muatnaik_gambar'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['boucher', 'no_cek'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'agensi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max, 'skipOnEmpty' => true],
            [['kelulusan', 'status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'kategori_geran', 'status_geran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'rujukan', 'status_terkini_pengeluaran_cek'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_tamat_kontrak'], 'compare', 'compareAttribute'=>'tarikh_mula_kontrak', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geran_bantuan_gaji_id' => GeneralLabel::geran_bantuan_gaji_id,
            'muatnaik_gambar' => GeneralLabel::muatnaik_gambar,
            'nama_jurulatih' => GeneralLabel::nama_jurulatih,
            'cawangan' => GeneralLabel::cawangan,
            'sub_cawangan' => GeneralLabel::sub_cawangan,
            'program_msn' => GeneralLabel::program,
            'lain_lain_program' => GeneralLabel::lain_lain_program,
            'pusat_latihan' => GeneralLabel::pusat_latihan,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'tarikh_mula' => GeneralLabel::tarikh_mula_bayaran,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat_bayaran,
            'status_jurulatih' => GeneralLabel::status_jurulatih,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'status_keaktifan_jurulatih' => GeneralLabel::status_keaktifan_jurulatih,
            'kategori_geran' => GeneralLabel::kategori_geran,
            'jumlah_geran' => GeneralLabel::jumlah_geran,
            'status_geran' => GeneralLabel::status_geran,
            'kelulusan' => GeneralLabel::kelulusan,
            'catatan' => GeneralLabel::catatan,
            'tarikh_mula_kontrak' => GeneralLabel::tarikh_mula_kontrak,
            'tarikh_tamat_kontrak' => GeneralLabel::tarikh_tamat_kontrak,
            'agensi' => GeneralLabel::agensi_pelantik,
            'kadar' => GeneralLabel::kadar,
            'bulan' => GeneralLabel::bulan,
            'rujukan' => GeneralLabel::rujukan,
            'status_terkini_pengeluaran_cek' => GeneralLabel::status_terkini_pengeluaran_cek,
            'boucher' => GeneralLabel::boucher,  //'Boucher (BR)',
            'no_cek' => GeneralLabel::no_cek,  //'No. Cek',
            'tarikh_cek' => GeneralLabel::tarikh,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanGeranBantuanGajiJurulatih(){
        return $this->hasOne(RefStatusPermohonanGeranBantuanGajiJurulatih::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriGeranJurulatih(){
        return $this->hasOne(RefKategoriGeranJurulatih::className(), ['id' => 'kategori_geran']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusanGeranBantuanGajiJurulatih::className(), ['id' => 'kelulusan']);
    }
}
