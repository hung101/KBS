<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_penyelidikan_komposisi_pasukan".
 *
 * @property integer $penyelidikan_komposisi_pasukan_id
 * @property integer $permohonana_penyelidikan_id
 * @property string $nama
 * @property string $pasukan
 * @property string $jawatan
 * @property string $telefon_no
 * @property string $emel
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $institusi_universiti_syarikat
 */
class PenyelidikanKomposisiPasukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyelidikan_komposisi_pasukan';
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
            [['nama', 'pasukan', 'telefon_no', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'institusi_universiti_syarikat'], 'required', 'skipOnEmpty' => true],
            [['permohonana_penyelidikan_id'], 'integer'],
            [['nama', 'institusi_universiti_syarikat'], 'string', 'max' => 80],
            [['pasukan', 'jawatan', 'alamat_negeri'], 'string', 'max' => 30],
            [['telefon_no'], 'string', 'max' => 14],
            [['emel'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyelidikan_komposisi_pasukan_id' => GeneralLabel::penyelidikan_komposisi_pasukan_id,
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'nama' => GeneralLabel::nama,
            'pasukan' => GeneralLabel::pasukan,
            'jawatan' => GeneralLabel::jawatan,
            'telefon_no' => GeneralLabel::telefon_no,
            'emel' => GeneralLabel::emel,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'institusi_universiti_syarikat' => GeneralLabel::institusi_universiti_syarikat,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPasukanPenyelidikan(){
        return $this->hasOne(RefPasukanPenyelidikan::className(), ['id' => 'pasukan']);
    }
}
