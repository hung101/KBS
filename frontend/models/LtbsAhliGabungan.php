<?php

namespace app\models;

use Yii;

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
            [['peringkat_badan_sukan', 'alamat_badan_sukan_1', 'alamat_badan_sukan_negeri', 'alamat_badan_sukan_bandar', 'alamat_badan_sukan_poskod', 'nama_penuh_presiden_badan_sukan', 'no_tel_bimbit_presiden_badan_sukan', 'no_tel_bimbit_setiausaha_badan_sukan', 'nama_penuh_setiausaha_badan_sukan', 'status'], 'required', 'skipOnEmpty' => true],
            [['nama_badan_sukan', 'nama_penuh_presiden_badan_sukan', 'nama_penuh_setiausaha_badan_sukan'], 'string', 'max' => 80],
            [['alamat_badan_sukan_1', 'alamat_badan_sukan_2', 'alamat_badan_sukan_3'], 'string', 'max' => 30],
            [['emel_presiden_badan_sukan', 'emel_setiausaha_badan_sukan'], 'email'],
            [['alamat_badan_sukan_poskod'], 'string', 'max' => 5],
            [['profil_badan_sukan_id', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ahli_gabungan_id' => 'Ahli Gabungan ID',
            'profil_badan_sukan_id' => 'Badan Sukan',
            'nama_badan_sukan' => 'Nama Badan Sukan',
            'peringkat_badan_sukan' => 'Peringkat Badan Sukan',
            'alamat_badan_sukan_1' => 'Alamat Badan Sukan',
            'alamat_badan_sukan_2' => '',
            'alamat_badan_sukan_3' => '',
            'alamat_badan_sukan_negeri' => 'Negeri',
            'alamat_badan_sukan_bandar' => 'Bandar',
            'alamat_badan_sukan_poskod' => 'Poskod',
            'nama_penuh_presiden_badan_sukan' => 'Nama Penuh Presiden Badan Sukan',
            'no_tel_bimbit_presiden_badan_sukan' => 'No Tel',
            'emel_presiden_badan_sukan' => 'Emel',
            'nama_penuh_setiausaha_badan_sukan' => 'Nama Penuh Setiausaha Badan Sukan',
            'no_tel_bimbit_setiausaha_badan_sukan' => 'No Tel',
            'emel_setiausaha_badan_sukan' => 'Emel',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'profil_badan_sukan_id']);
    }
}
