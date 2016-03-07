<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_farmasi_permohonan_ubatan".
 *
 * @property integer $farmasi_permohonan_ubatan_id
 * @property integer $atlet_id
 * @property string $tarikh_pemberian
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 * @property integer $kelulusan
 */
class FarmasiPermohonanUbatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_permohonan_ubatan';
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
            //[['atlet_id', 'tarikh_pemberian', 'pegawai_yang_bertanggungjawab', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['tarikh_pemberian'], 'safe'],
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
            'farmasi_permohonan_ubatan_id' => 'Farmasi Permohonan Ubatan ID',
            'atlet_id' => 'Atlet ID',
            'tarikh_pemberian' => 'Tarikh Pemberian',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'catitan_ringkas' => 'Catitan Ringkas',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}
