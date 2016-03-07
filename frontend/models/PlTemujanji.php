<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pl_temujanji".
 *
 * @property integer $pl_temujanji_id
 * @property integer $atlet_id
 * @property string $tarikh_temujanji
 * @property string $doktor_pegawai_perubatan
 * @property string $makmal_perubatan
 * @property string $status_temujanji
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PlTemujanji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_temujanji';
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
            [['atlet_id', 'tarikh_temujanji', 'doktor_pegawai_perubatan', 'status_temujanji', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_temujanji'], 'safe'],
            [['doktor_pegawai_perubatan', 'makmal_perubatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['status_temujanji'], 'string', 'max' => 30],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_temujanji_id' => 'Pl Temujanji ID',
            'atlet_id' => 'Atlet ID',
            'tarikh_temujanji' => 'Tarikh Temujanji',
            'doktor_pegawai_perubatan' => 'Fisioterapi',
            'makmal_perubatan' => 'Jenis Temujanji',
            'status_temujanji' => 'Status Temujanji',
            'pegawai_yang_bertanggungjawab' => 'Doktor/Pegawai Perubatan/Pemeriksaan',
            'catitan_ringkas' => 'Catitan Ringkas',
        ];
    }
    
    public function getRefStatusTemujanjiPesakitLuar()
    {
        return $this->hasOne(RefStatusTemujanjiPesakitLuar::className(), ['id' => 'status_temujanji']);
    }
}
