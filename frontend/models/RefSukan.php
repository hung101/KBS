<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_sukan".
 *
 * @property integer $ref_sukan_id
 * @property string $nama_sukan
 * @property integer $aktif
 */
class RefSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_sukan';
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
            [['ref_kategori_sukan_id','desc', 'aktif'], 'required'],
            [['aktif'], 'integer'],
            [['desc'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ref_sukan_id' => 'Ref Sukan ID',
            'ref_kategori_sukan_id' => 'Kategori Sukan',
            'desc' => 'Nama Sukan',
            'aktif' => 'Aktif',
        ];
    }

    public function getRefKategoriSukan() {
        return $this->hasOne(RefKategoriSukan::className(), ['id' => 'ref_kategori_sukan_id']);
    }
}
