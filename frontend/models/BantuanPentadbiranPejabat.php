<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_pentadbiran_pejabat".
 *
 * @property integer $bantuan_pentadbiran_pejabat_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $status_permohonan
 * @property string $catatan
 */
class BantuanPentadbiranPejabat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_pentadbiran_pejabat';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir', 'tarikh'], 'safe'],
            [['nama', 'nama_sue', 'jawatan', 'persatuan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'status_permohonan'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_pentadbiran_pejabat_id' => 'Bantuan Pentadbiran Pejabat ID',
            'nama' => 'Nama Permohon',
            'jawatan' => 'Jawatan',
            'persatuan' => 'Persatuan',
            'tarikh' => 'Tarikh',
            'nama_sue' => 'Nama SUE',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'tarikh_lahir' => 'Tarikh Lahir',
            'alamat_1' => 'Alamat Persatuan',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_tel_bimbit' => 'No Tel',
            'no_faks' => 'No Tel',
            'emel' => 'Emel',
            'jumlah_dipohon' => 'Jumlah Dipohon',
            'status_permohonan' => 'Status Permohonan',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanBantuanPentadbiranPejabat(){
        return $this->hasOne(RefStatusPermohonanBantuanPentadbiranPejabat::className(), ['id' => 'status_permohonan']);
    }
}
