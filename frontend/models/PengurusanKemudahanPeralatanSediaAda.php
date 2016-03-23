<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_peralatan_sedia_ada".
 *
 * @property integer $pengurusan_kemudahan_peralatan_sedia_ada_id
 * @property integer $pengurusan_kemudahan_venue_id
 * @property string $nama_peralatan
 * @property integer $kuantiti
 */
class PengurusanKemudahanPeralatanSediaAda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_peralatan_sedia_ada';
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
            [['pengurusan_kemudahan_venue_id', 'nama_peralatan', 'kuantiti'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_kemudahan_venue_id', 'kuantiti', 'jenama'], 'integer'],
            [['nama_peralatan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_peralatan_sedia_ada_id' => GeneralLabel::pengurusan_kemudahan_peralatan_sedia_ada_id,
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'nama_kemudahan' => GeneralLabel::nama_kemudahan,
            'jenama' => GeneralLabel::jenama,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'kuantiti' => GeneralLabel::kuantiti,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanKemudahan(){
        return $this->hasOne(RefPeralatanKemudahan::className(), ['id' => 'nama_peralatan']);
    }
}
