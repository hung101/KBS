<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            [['nama', 'jawatan', 'gelaran', 'pasukan', 'telefon_no', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'institusi_universiti_syarikat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonana_penyelidikan_id', 'gelaran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama', 'institusi_universiti_syarikat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pasukan', 'jawatan', 'alamat_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['telefon_no'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['telefon_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max]
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
            'gelaran' => GeneralLabel::gelaran,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPasukanPenyelidikan(){
        return $this->hasOne(RefPasukanPenyelidikan::className(), ['id' => 'pasukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanPasukanPenyelidikan(){
        return $this->hasOne(RefJawatanPasukanPenyelidikan::className(), ['id' => 'jawatan']);
    }
}
