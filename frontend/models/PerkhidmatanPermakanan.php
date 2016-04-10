<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            'perkhidmatan_permakanan_id' => GeneralLabel::perkhidmatan_permakanan_id,
            'permohonan_perkhidmatan_permakanan_id' => GeneralLabel::permohonan_perkhidmatan_permakanan_id,
            'tarikh' => GeneralLabel::tarikh,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,

        ];
    }
}
