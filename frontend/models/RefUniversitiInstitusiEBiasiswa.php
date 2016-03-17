<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_universiti_institusi_e_biasiswa".
 *
 * @property integer $id
 * @property integer $ref_universiti_institusi_kategori_e_biasiswa_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefUniversitiInstitusiEBiasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_universiti_institusi_e_biasiswa';
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
            [['ref_universiti_institusi_kategori_e_biasiswa_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_universiti_institusi_kategori_e_biasiswa_id' => 'Ref Universiti Institusi Kategori E Biasiswa',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    public function getRefUniversitiInstitusiKategoriEBiasiswa() {
        return $this->hasOne(RefUniversitiInstitusiKategoriEBiasiswa::className(), ['id' => 'ref_universiti_institusi_kategori_e_biasiswa_id']);
    }
}
