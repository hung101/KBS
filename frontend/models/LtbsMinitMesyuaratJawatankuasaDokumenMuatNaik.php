<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik".
 *
 * @property integer $dokumen_muat_naik_id
 * @property integer $mesyuarat_id
 * @property string $nama_dokumen
 * @property string $muat_naik
 */
class LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik';
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
            [['nama_dokumen'], 'required', 'skipOnEmpty' => true],
            [['mesyuarat_id'], 'integer'],
            [['nama_dokumen'], 'string', 'max' => 80],
            [['muat_naik'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dokumen_muat_naik_id' => GeneralLabel::dokumen_muat_naik_id,
            'mesyuarat_id' => GeneralLabel::mesyuarat_id,
            'nama_dokumen' => GeneralLabel::nama_dokumen,
            'muat_naik' => GeneralLabel::muat_naik,

        ];
    }
}
