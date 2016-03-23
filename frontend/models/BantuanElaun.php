<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_elaun".
 *
 * @property integer $bantuan_elaun_id
 * @property string $nama
 * @property string $muatnaik_gambar
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property integer $umur
 * @property string $jantina
 * @property string $kewarganegara
 * @property string $bangsa
 * @property string $agama
 * @property string $kelayakan_akademi
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $emel
 * @property string $kontrak
 * @property string $jumlah_elaun
 * @property string $muatnaik_dokumen
 * @property string $status_permohonan
 * @property string $catatan
 */
class BantuanElaun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_elaun';
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
            [['nama', 'jenis_bantuan', 'tarikh', 'nama_persatuan', 'tarikh_mula_dilantik', 'tarikh_tamat_dilantik', 'no_kad_pengenalan', 'tarikh_lahir', 'umur', 'jantina', 'kewarganegara', 'bangsa', 'agama', 'kelayakan_akademi', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'kontrak', 'jumlah_elaun', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['umur'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['nama', 'kelayakan_akademi'], 'string', 'max' => 80],
            [['muatnaik_gambar', 'emel', 'muatnaik_dokumen'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['kewarganegara', 'alamat_negeri', 'status_permohonan'], 'string', 'max' => 30],
            [['bangsa', 'agama'], 'string', 'max' => 25],
            [['alamat_1', 'alamat_2', 'alamat_3', 'kontrak'], 'string', 'max' => 90],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit', 'no_tel_persatuan_pejabat'], 'string', 'max' => 14],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_elaun_id' => GeneralLabel::bantuan_elaun_id,
            'jenis_bantuan' => GeneralLabel::jenis_bantuan,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'jawatan' => GeneralLabel::jawatan,
            'persatuan' => GeneralLabel::persatuan,
            'tarikh' => GeneralLabel::tarikh,
            'nama_persatuan' => GeneralLabel::nama_persatuan,
            'tarikh_mula_dilantik' => GeneralLabel::tarikh_mula_dilantik,
            'tarikh_tamat_dilantik' => GeneralLabel::tarikh_tamat_dilantik,
            'nama' => GeneralLabel::nama,
            'muatnaik_gambar' => GeneralLabel::muatnaik_gambar,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'umur' => GeneralLabel::umur,
            'jantina' => GeneralLabel::jantina,
            'kewarganegara' => GeneralLabel::kewarganegara,
            'bangsa' => GeneralLabel::bangsa,
            'agama' => GeneralLabel::agama,
            'kelayakan_akademi' => GeneralLabel::kelayakan_akademi,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'no_tel_persatuan_pejabat' => GeneralLabel::no_tel_persatuan_pejabat,
            'emel' => GeneralLabel::emel,
            'kontrak' => GeneralLabel::kontrak,
            'jumlah_elaun' => GeneralLabel::jumlah_elaun,
            'muatnaik_dokumen' => GeneralLabel::muatnaik_dokumen,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'catatan' => GeneralLabel::catatan,

        ];
    }
}
