<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_jurulatih_keluarga".
 *
 * @property integer $jurulatih_keluarga_id
 * @property integer $jurulatih_id
 * @property string $nama_suami_isteri_waris
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $emel
 * @property string $no_telefon
 */
class JurulatihKeluarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_keluarga';
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
            [['jurulatih_id', 'nama_suami_isteri_waris', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon'], 'required', 'skipOnEmpty' => true],
            [['jurulatih_id'], 'integer'],
            [['nama_suami_isteri_waris'], 'string', 'max' => 80],
            [['alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3'], 'string', 'max' => 90],
            [['alamat_surat_menyurat_negeri'], 'string', 'max' => 30],
            [['alamat_surat_menyurat_bandar'], 'string', 'max' => 40],
            [['alamat_surat_menyurat_poskod'], 'string', 'max' => 5],
            [['emel'], 'string', 'max' => 100],
            [['no_telefon', 'no_telefon_bimbit'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_keluarga_id' => GeneralLabel::jurulatih_keluarga_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'nama_suami_isteri_waris' => GeneralLabel::nama_suami_isteri_waris,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_menyurat_negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
            'alamat_surat_menyurat_bandar' => GeneralLabel::alamat_surat_menyurat_bandar,
            'alamat_surat_menyurat_poskod' => GeneralLabel::alamat_surat_menyurat_poskod,
            'emel' => GeneralLabel::emel,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,

        ];
    }
}
