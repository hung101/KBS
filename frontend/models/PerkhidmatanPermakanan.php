<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_perkhidmatan_permakanan".
 *
 * @property integer $perkhidmatan_permakanan_id
 * @property integer $permohonan_perkhidmatan_permakanan_id
 * @property string $tarikh
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PerkhidmatanPermakanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perkhidmatan_permakanan';
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
            [['tarikh', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true],
            [['permohonan_perkhidmatan_permakanan_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perkhidmatan_permakanan_id' => 'Perkhidmatan Permakanan ID',
            'permohonan_perkhidmatan_permakanan_id' => 'Permohonan Perkhidmatan Permakanan ID',
            'tarikh' => 'Tarikh',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'catitan_ringkas' => 'Catitan Ringkas',
        ];
    }
}
