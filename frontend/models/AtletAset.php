<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_aset".
 *
 * @property integer $aset_id
 * @property integer $atlet_id
 * @property string $jenis_aset
 * @property string $daftar_no_pengangkutan
 * @property string $jenis_harta_pengangkutan_perniagaan
 * @property string $nilai_harta_pengangkutan
 * @property string $daftar_alamat
 * @property string $nama_syarikat_perniagaan
 * @property string $produk_perkhidmatan_perniagaan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AtletAset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_aset';
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
            [['atlet_id', 'jenis_aset', 'jenis_harta_pengangkutan_perniagaan', 'nilai_harta_pengangkutan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'created_by', 'updated_by'], 'integer'],
            [['nilai_harta_pengangkutan'], 'number'],
            [['nama_bank','jenis_pinjaman','tarikh_mula','tarikh_tamat','no_akaun', 'nilai_pinjaman', 'daftar_alamat_negeri', 'daftar_alamat_bandar', 'daftar_alamat_poskod', 'created', 'updated'], 'safe'],
            [['jenis_aset', 'jenis_harta_pengangkutan_perniagaan'], 'string', 'max' => 30],
            [['daftar_no_pengangkutan'], 'string', 'max' => 10],
            [['daftar_alamat_1', 'daftar_alamat_2', 'daftar_alamat_3'], 'string', 'max' => 30],
            [['nama_syarikat_perniagaan', 'produk_perkhidmatan_perniagaan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aset_id' => GeneralLabel::aset_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_aset' => GeneralLabel::jenis_aset,
            'daftar_no_pengangkutan' => GeneralLabel::daftar_no_pengangkutan,
            'jenis_harta_pengangkutan_perniagaan' => GeneralLabel::jenis_harta_pengangkutan_perniagaan,
            'nilai_harta_pengangkutan' => GeneralLabel::nilai_harta_pengangkutan,
            'daftar_alamat_1' => GeneralLabel::daftar_alamat_1,
            'daftar_alamat_2' => GeneralLabel::daftar_alamat_2,
            'daftar_alamat_3' => GeneralLabel::daftar_alamat_3,
            'daftar_alamat_negeri' => GeneralLabel::daftar_alamat_negeri,
            'daftar_alamat_bandar' => GeneralLabel::daftar_alamat_bandar,
            'daftar_alamat_poskod' => GeneralLabel::daftar_alamat_poskod,
            'nama_syarikat_perniagaan' => GeneralLabel::nama_syarikat_perniagaan,
            'produk_perkhidmatan_perniagaan' => GeneralLabel::produk_perkhidmatan_perniagaan,
            'nama_bank' => GeneralLabel::nama_bank,
            'jenis_pinjaman' => GeneralLabel::jenis_pinjaman,
            'no_akaun' => GeneralLabel::no_akaun,
            'nilai_pinjaman' => GeneralLabel::nilai_pinjaman,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisAset(){
        return $this->hasOne(RefJenisAset::className(), ['id' => 'jenis_aset']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisAsetSub(){
        return $this->hasOne(RefJenisAsetSub::className(), ['id' => 'jenis_harta_pengangkutan_perniagaan']);
    }
}
