<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user_peranan".
 *
 * @property integer $user_peranan_id
 * @property string $nama_peranan
 * @property string $peranan_akses
 * @property integer $aktif
 */
class UserPeranan extends \yii\db\ActiveRecord
{
    public $msn;
    public $isn;
    public $pjs;
    public $kbs;
    
    const PERANAN_PJS_PERSATUAN = 6;
    const PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT = 7;
    const PERANAN_KBS_E_BANTUAN_URUSETIA = 8;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_peranan';
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
            [['nama_peranan', 'peranan_akses', 'aktif'], 'required'],
            [['peranan_akses'], 'safe'],
            [['aktif'], 'integer'],
            [['nama_peranan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_peranan_id' => 'User Peranan ID',
            'nama_peranan' => 'Nama Peranan',
            'peranan_akses' => 'Peranan Akses',
            'aktif' => 'Aktif',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'aktif']);
    }
}
