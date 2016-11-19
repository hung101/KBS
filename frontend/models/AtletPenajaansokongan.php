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
            'encryption' => [
                'class' => '\nickcv\encrypter\behaviors\EncryptionBehavior',
                'attributes' => [
                    'nilai_kontrak',
                ],
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
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nilai_kontrak'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['tahun_permulaan', 'tahun_akhir'], 'safe'],
            [['nama_syarikat', 'emel', 'barang_yang_penyokong'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peribadi_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_kontrak', 'alamat_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
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
            'nama_syarikat' => GeneralLabel::agensi,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'emel' => GeneralLabel::e_mel,
            'no_telefon' => GeneralLabel::no_telefon,
            'peribadi_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'jenis_kontrak' => GeneralLabel::jenis_kontrak,
            'nilai_kontrak' => GeneralLabel::nilai_kontrak,
            'tahun_permulaan' => GeneralLabel::tahun_permulaan,
            'tahun_akhir' => GeneralLabel::tahun_akhir,
            'barang_yang_penyokong' => 'Bentuk Tajaan',

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'alamat_negeri']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBandar(){
        return $this->hasOne(RefBandar::className(), ['id' => 'alamat_bandar']);
    }
}
