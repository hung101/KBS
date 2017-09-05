<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_kedudukan_kewangan_penjamin".
 *
 * @property integer $bsp_kedudukan_kewangan_penjamin_id
 * @property integer $bsp_penjamin_id
 * @property string $pendapatan_bulanan
 * @property string $pinjaman_perumahan_baki_terkini
 * @property string $sebagai_penjamin_siberhutang
 * @property string $lain_lain_pinjaman_tanggungan
 * @property string $perkerjaan
 * @property string $nama_alamat_majikan
 * @property string $nama_isteri_suami
 * @property string $no_kp_isteri_suami
 * @property integer $jumlah_anak
 * @property string $pertalian_keluarga_dengan_pelajar
 * @property string $pelajar_lain_selain_daripada_penerima_di_atas
 */
class BspKedudukanKewanganPenjamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_kedudukan_kewangan_penjamin';
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
            [['pendapatan_bulanan', 'perkerjaan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_penjamin_id', 'jumlah_anak','no_kp_isteri_suami'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['pendapatan_bulanan', 'pinjaman_perumahan_baki_terkini', 'sebagai_penjamin_siberhutang', 'lain_lain_pinjaman_tanggungan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['perkerjaan', 'pertalian_keluarga_dengan_pelajar'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_alamat_majikan', 'pelajar_lain_selain_daripada_penerima_di_atas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_isteri_suami'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kp_isteri_suami'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['perkerjaan', 'pertalian_keluarga_dengan_pelajar','nama_alamat_majikan', 'pelajar_lain_selain_daripada_penerima_di_atas','nama_isteri_suami',
                ], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_kedudukan_kewangan_penjamin_id' => GeneralLabel::bsp_kedudukan_kewangan_penjamin_id,
            'bsp_penjamin_id' => GeneralLabel::bsp_penjamin_id,
            'pendapatan_bulanan' => GeneralLabel::pendapatan_bulanan,
            'pinjaman_perumahan_baki_terkini' => GeneralLabel::pinjaman_perumahan_baki_terkini,
            'sebagai_penjamin_siberhutang' => GeneralLabel::sebagai_penjamin_siberhutang,
            'lain_lain_pinjaman_tanggungan' => GeneralLabel::lain_lain_pinjaman_tanggungan,
            'perkerjaan' => GeneralLabel::perkerjaan,
            'nama_alamat_majikan' => GeneralLabel::nama_alamat_majikan,
            'nama_isteri_suami' => GeneralLabel::nama_isteri_suami,
            'no_kp_isteri_suami' => GeneralLabel::no_kp_isteri_suami,
            'jumlah_anak' => GeneralLabel::jumlah_anak,
            'pertalian_keluarga_dengan_pelajar' => GeneralLabel::pertalian_keluarga_dengan_pelajar,
            'pelajar_lain_selain_daripada_penerima_di_atas' => GeneralLabel::pelajar_lain_selain_daripada_penerima_di_atas,

        ];
    }
}
