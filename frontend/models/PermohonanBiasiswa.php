<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_biasiswa".
 *
 * @property integer $permohonan_biasiswa_id
 * @property integer $atlet_id
 * @property string $no_ic
 * @property integer $umur
 * @property string $jantina
 * @property string $alamat_rumah_1
 * @property string $alamat_rumah_2
 * @property string $alamat_rumah_3
 * @property string $alamat_rumah_negeri
 * @property string $alamat_rumah_bandar
 * @property string $alamat_rumah_poskod
 * @property string $no_tel_rumah
 * @property string $no_tel_bimbit
 * @property string $alamat_pengajian_1
 * @property string $alamat_pengajian_2
 * @property string $alamat_pengajian_3
 * @property string $alamat_pengajian_negeri
 * @property string $alamat_pengajian_bandar
 * @property string $alamat_pengajian_poskod
 * @property string $no_tel_pengajian
 * @property string $no_fax_pengajian
 * @property string $jenis_biasiswa
 * @property string $muatnaik
 * @property integer $kelulusan
 */
class PermohonanBiasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_biasiswa';
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
            [['atlet_id','sukan','nama_institusi_pengajian','tarikh_mula_pengajian','tarikh_tamat_pengajian','nama_program_pengajian', 'no_ic', 'umur', 'jantina', 'alamat_rumah_1', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'no_tel_rumah', 'no_tel_bimbit', 'jenis_biasiswa', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'umur', 'kelulusan'], 'integer'],
            [['no_ic'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_pengajian_1', 'alamat_pengajian_2', 'alamat_pengajian_3'], 'string', 'max' => 90],
            [['alamat_rumah_negeri', 'alamat_pengajian_negeri'], 'string', 'max' => 30],
            [['alamat_rumah_bandar', 'alamat_pengajian_bandar'], 'string', 'max' => 40],
            [['alamat_rumah_poskod', 'alamat_pengajian_poskod'], 'string', 'max' => 5],
            [['no_tel_rumah', 'no_tel_bimbit', 'no_tel_pengajian', 'no_fax_pengajian'], 'string', 'max' => 14],
            [['jenis_biasiswa'], 'string', 'max' => 80],
            [['muatnaik'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_biasiswa_id' => GeneralLabel::permohonan_biasiswa_id,
            'sukan' => GeneralLabel::sukan,
            'nama_institusi_pengajian' => GeneralLabel::nama_institusi_pengajian,
            'tarikh_mula_pengajian' => GeneralLabel::tarikh_mula_pengajian,
            'tarikh_tamat_pengajian' => GeneralLabel::tarikh_tamat_pengajian,
            'nama_program_pengajian' => GeneralLabel::nama_program_pengajian,
            'atlet_id' => GeneralLabel::atlet_id,
            'no_ic' => GeneralLabel::no_ic,
            'umur' => GeneralLabel::umur,
            'jantina' => GeneralLabel::jantina,
            'alamat_rumah_1' => GeneralLabel::alamat_rumah_1,
            'alamat_rumah_2' => GeneralLabel::alamat_rumah_2,
            'alamat_rumah_3' => GeneralLabel::alamat_rumah_3,
            'alamat_rumah_negeri' => GeneralLabel::alamat_rumah_negeri,
            'alamat_rumah_bandar' => GeneralLabel::alamat_rumah_bandar,
            'alamat_rumah_poskod' => GeneralLabel::alamat_rumah_poskod,
            'no_tel_rumah' => GeneralLabel::no_tel_rumah,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'alamat_pengajian_1' => GeneralLabel::alamat_pengajian_1,
            'alamat_pengajian_2' => GeneralLabel::alamat_pengajian_2,
            'alamat_pengajian_3' => GeneralLabel::alamat_pengajian_3,
            'alamat_pengajian_negeri' => GeneralLabel::alamat_pengajian_negeri,
            'alamat_pengajian_bandar' => GeneralLabel::alamat_pengajian_bandar,
            'alamat_pengajian_poskod' => GeneralLabel::alamat_pengajian_poskod,
            'no_tel_pengajian' => GeneralLabel::no_tel_pengajian,
            'no_fax_pengajian' => GeneralLabel::no_fax_pengajian,
            'jenis_biasiswa' => GeneralLabel::jenis_biasiswa,
            'muatnaik' => GeneralLabel::muatnaik,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
