<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_kontraktor".
 *
 * @property integer $pengurusan_kontraktor_id
 * @property string $nama_kontraktor
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $telefon_pejabat
 * @property string $telefon_bimbit
 * @property string $peralatan_yang_dibekal
 */
class PengurusanKontraktor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kontraktor';
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
            [['nama_kontraktor', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'telefon_pejabat', 'telefon_bimbit', 'peralatan_yang_dibekal'], 'required', 'skipOnEmpty' => true],
            [['nama_kontraktor', 'peralatan_yang_dibekal'], 'string', 'max' => 80],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['telefon_pejabat', 'telefon_bimbit'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kontraktor_id' => GeneralLabel::pengurusan_kontraktor_id,
            'nama_kontraktor' => GeneralLabel::nama_kontraktor,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'telefon_pejabat' => GeneralLabel::telefon_pejabat,
            'telefon_bimbit' => GeneralLabel::telefon_bimbit,
            'peralatan_yang_dibekal' => GeneralLabel::peralatan_yang_dibekal,

        ];
    }
}
