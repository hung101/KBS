<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_profil_peserta_kpsk_peserta".
 *
 * @property integer $borang_profil_peserta_kpsk_peserta_id
 * @property integer $borang_profil_peserta_kpsk_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property integer $umur
 * @property string $jantina
 * @property integer $bangsa
 * @property integer $agama
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_telefon_bimbit
 * @property string $emel
 * @property string $facebook
 * @property integer $akademik
 * @property string $pekerjaan
 * @property string $nama_majikan
 * @property integer $keputusan
 * @property integer $objektif
 * @property integer $struktur
 * @property integer $esei
 * @property integer $jumlah
 * @property string $catatan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BorangProfilPesertaKpskPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_profil_peserta_kpsk_peserta';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'bangsa', 'agama', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod',
                'emel', 'akademik', 'no_telefon_bimbit'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['borang_profil_peserta_kpsk_id', 'umur', 'bangsa', 'agama', 'akademik', 'keputusan', 'objektif', 'struktur', 'esei', 'jumlah', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_lahir', 'created', 'updated'], 'safe'],
            [['struktur', 'esei'], 'integer', 'max' => 20, 'min' => 0],
            [['objektif'], 'integer', 'max' => 60, 'min' => 0],
            [['nama', 'pekerjaan', 'nama_majikan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['jantina'], 'string', 'max' => 1],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_telefon_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_telefon_bimbit'], 'string', 'max' => 14],
            [['emel', 'facebook', 'session_id'], 'string', 'max' => 100],
            [['catatan'], 'string', 'max' => 255],
            [['kehadiran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_profil_peserta_kpsk_peserta_id' => 'Borang Profil Peserta Kpsk Peserta ID',
            'borang_profil_peserta_kpsk_id' => 'Borang Profil Peserta Kpsk ID',
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'umur' => GeneralLabel::umur,
            'jantina' => GeneralLabel::jantina,
            'bangsa' => GeneralLabel::bangsa,
            'agama' => GeneralLabel::agama,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'akademik' => GeneralLabel::akademik,
            'pekerjaan' => GeneralLabel::pekerjaan,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'keputusan' => GeneralLabel::keputusan,
            'objektif' => GeneralLabel::objektif_60,
            'struktur' => GeneralLabel::struktur,
            'esei' => GeneralLabel::esei,
            'jumlah' => GeneralLabel::jumlah_markah,
            'catatan' => GeneralLabel::catatan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'kehadiran' => 'Kehadiran',
        ];
    }
    
    public function getRefKeputusanKpsk()
    {
        return $this->hasOne(RefKeputusanKpsk::className(), ['id' => 'keputusan']);
    }
    
    public function getRefKehadiran()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kehadiran'])->from(['rk1' => RefKelulusan::tableName()]);
    }
    
}
