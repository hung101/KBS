<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ltbs_ahli_gabungan".
 *
 * @property integer $ahli_gabungan_id
 * @property string $nama_badan_sukan
 * @property string $alamat_badan_sukan
 * @property string $nama_penuh_presiden_badan_sukan
 * @property string $nama_penuh_setiausaha_badan_sukan
 */
class LtbsAhliGabungan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_ahli_gabungan';
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
            [['peringkat_badan_sukan', 'alamat_badan_sukan_1', 'alamat_badan_sukan_negeri', 'alamat_badan_sukan_poskod', 
                'nama_penuh_presiden_badan_sukan', 'no_tel_bimbit_presiden_badan_sukan', 'no_tel_bimbit_setiausaha_badan_sukan', 
                'nama_penuh_setiausaha_badan_sukan', 'status', 'nama'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_badan_sukan', 'nama_penuh_presiden_badan_sukan', 'nama_penuh_setiausaha_badan_sukan', 'nama'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_badan_sukan_1', 'alamat_badan_sukan_2', 'alamat_badan_sukan_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel_presiden_badan_sukan', 'emel_setiausaha_badan_sukan'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['alamat_badan_sukan_poskod', 'alamat_badan_sukan_bandar'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit_presiden_badan_sukan', 'no_tel_bimbit_setiausaha_badan_sukan'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],            
            [['profil_badan_sukan_id', 'status', 'alamat_badan_sukan_poskod', 'no_tel_bimbit_presiden_badan_sukan', 'no_tel_bimbit_setiausaha_badan_sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ahli_gabungan_id' => GeneralLabel::ahli_gabungan_id,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan,
            'peringkat_badan_sukan' => GeneralLabel::peringkat_badan_sukan,
            'alamat_badan_sukan_1' => GeneralLabel::alamat_badan_sukan_1,
            'alamat_badan_sukan_2' => GeneralLabel::alamat_badan_sukan_2,
            'alamat_badan_sukan_3' => GeneralLabel::alamat_badan_sukan_3,
            'alamat_badan_sukan_negeri' => GeneralLabel::alamat_badan_sukan_negeri,
            'alamat_badan_sukan_bandar' => GeneralLabel::alamat_badan_sukan_bandar,
            'alamat_badan_sukan_poskod' => GeneralLabel::alamat_badan_sukan_poskod,
            'nama_penuh_presiden_badan_sukan' => GeneralLabel::nama_penuh_presiden_badan_sukan,
            'no_tel_bimbit_presiden_badan_sukan' => GeneralLabel::no_tel_bimbit_presiden_badan_sukan,
            'emel_presiden_badan_sukan' => GeneralLabel::emel_presiden_badan_sukan,
            'nama_penuh_setiausaha_badan_sukan' => GeneralLabel::nama_penuh_setiausaha_badan_sukan,
            'no_tel_bimbit_setiausaha_badan_sukan' => GeneralLabel::no_tel_bimbit_setiausaha_badan_sukan,
            'emel_setiausaha_badan_sukan' => GeneralLabel::emel_setiausaha_badan_sukan,
            'status' => GeneralLabel::status,
            'nama' => GeneralLabel::nama,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'profil_badan_sukan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusLaporanMesyuaratAgung(){
        return $this->hasOne(RefStatusLaporanMesyuaratAgung::className(), ['id' => 'status']);
    }
}
