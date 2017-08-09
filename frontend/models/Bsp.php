<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp".
 *
 * @property integer $bsp_pemohon_id
 * @property integer $atlet_id
 * @property string $peringkat_pengajian
 * @property string $bidang_pengajian
 * @property string $falkuti_pengajian
 * @property string $ipt
 * @property string $tahun_mula_pengajian
 * @property string $tahun_tamat_pengajian
 * @property string $tahun_ditawarkan_biasiswa
 * @property integer $kelulusan
 */
class Bsp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp';
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
            [['nama_penerima','no_kad_pengenalan','alamat_1','alamat_negeri','alamat_poskod','no_tel_bimbit','atlet_id', 'peringkat_pengajian', 'bidang_pengajian', 'falkuti_pengajian', 'ipt', 'tahun_mula_pengajian', 'tahun_tamat_pengajian', 'tahun_ditawarkan_biasiswa', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun_mula_pengajian', 'tahun_tamat_pengajian', 'tahun_ditawarkan_biasiswa'], 'safe'],
            [['peringkat_pengajian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bidang_pengajian', 'falkuti_pengajian', 'ipt'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peringkat_pengajian','bidang_pengajian', 'falkuti_pengajian', 'ipt'], 'filter', 'filter' => function ($value) {
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
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_penerima' => GeneralLabel::nama_penerima,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'peringkat_pengajian' => GeneralLabel::peringkat_pengajian,
            'bidang_pengajian' => GeneralLabel::bidang_pengajian,
            'falkuti_pengajian' => GeneralLabel::falkuti_pengajian,
            'ipt' => GeneralLabel::ipt,
            'tahun_mula_pengajian' => GeneralLabel::tahun_mula_pengajian,
            'tahun_tamat_pengajian' => GeneralLabel::tahun_tamat_pengajian,
            'tahun_ditawarkan_biasiswa' => GeneralLabel::tahun_ditawarkan_biasiswa,
            'kelulusan' => GeneralLabel::kelulusan,
            'temuduga_tarikh' => GeneralLabel::temuduga_tarikh,

        ];
    }
}
