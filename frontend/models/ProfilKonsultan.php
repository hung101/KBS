<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_konsultan".
 *
 * @property integer $profil_konsultan_id
 * @property string $nama_konsultan
 * @property string $ic_no
 * @property string $emel
 * @property string $no_bimbit
 * @property string $bidang_konsultansi
 */
class ProfilKonsultan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_konsultan';
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
            [['nama_konsultan', 'ic_no', 'no_bimbit'], 'required', 'skipOnEmpty' => true],
            [['nama_konsultan', 'bidang_konsultansi'], 'string', 'max' => 80],
            [['ic_no'], 'string', 'max' => 12],
            [['emel'], 'string', 'max' => 100],
            [['kepakaran_pengalaman'], 'string', 'max' => 255],
            [['no_bimbit'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_konsultan_id' => GeneralLabel::profil_konsultan_id,
            'nama_konsultan' => GeneralLabel::nama_konsultan,
            'ic_no' => GeneralLabel::ic_no,
            'emel' => GeneralLabel::emel,
            'no_bimbit' => GeneralLabel::no_bimbit,
            'bidang_konsultansi' => GeneralLabel::bidang_konsultansi,
            'kepakaran_pengalaman' => GeneralLabel::kepakaran_pengalaman,

        ];
    }
}
