<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_penajaansokongan".
 *
 * @property integer $penajaan_sokongan_id
 * @property integer $atlet_id
 * @property string $nama_syarikat
 * @property string $alamat
 * @property string $emel
 * @property string $no_telefon
 * @property string $peribadi_yang_bertanggungjawab
 * @property string $jenis_kontrak
 * @property string $nilai_kontrak
 * @property string $tahun_permulaan
 * @property string $tahun_akhir
 * @property string $barang_yang_penyokong
 */
class AtletPenajaansokongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_penajaansokongan';
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
            //[['atlet_id', 'nama_syarikat', 'no_telefon', 'peribadi_yang_bertanggungjawab', 'jenis_kontrak', 'nilai_kontrak', 'tahun_permulaan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['nilai_kontrak'], 'number'],
            [['tahun_permulaan', 'tahun_akhir'], 'integer'],
            [['tahun_permulaan', 'tahun_akhir'], 'string', 'max' => 4],
            [['nama_syarikat', 'emel', 'barang_yang_penyokong'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['no_telefon'], 'string', 'max' => 14],
            [['peribadi_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['jenis_kontrak', 'alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penajaan_sokongan_id' => GeneralLabel::penajaan_sokongan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_syarikat' => GeneralLabel::nama_syarikat,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'emel' => GeneralLabel::emel,
            'no_telefon' => GeneralLabel::no_telefon,
            'peribadi_yang_bertanggungjawab' => GeneralLabel::peribadi_yang_bertanggungjawab,
            'jenis_kontrak' => GeneralLabel::jenis_kontrak,
            'nilai_kontrak' => GeneralLabel::nilai_kontrak,
            'tahun_permulaan' => GeneralLabel::tahun_permulaan,
            'tahun_akhir' => GeneralLabel::tahun_akhir,
            'barang_yang_penyokong' => GeneralLabel::barang_yang_penyokong,

        ];
    }
}
