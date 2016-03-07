<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penjadualan_ujian_fisiologi".
 *
 * @property integer $penjadualan_ujian_fisiologi_id
 * @property integer $atlet_id
 * @property string $perkhidmatan
 * @property string $tarikh_masa
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PenjadualanUjianFisiologi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penjadualan_ujian_fisiologi';
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
            [['atlet_id', 'perkhidmatan', 'tarikh_masa', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_masa'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penjadualan_ujian_fisiologi_id' => 'Penjadualan Ujian Fisiologi ID',
            'atlet_id' => 'Atlet',
            'perkhidmatan' => 'Perkhidmatan',
            'tarikh_masa' => 'Tarikh Masa',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'catitan_ringkas' => 'Catitan Ringkas',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerkhidmatanFisiologi(){
        return $this->hasOne(RefPerkhidmatanFisiologi::className(), ['id' => 'perkhidmatan']);
    }
}
