<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_temujanji_komplimentari".
 *
 * @property integer $temujanji_komplimentari_id
 * @property integer $atlet_id
 * @property string $perkhidmatan
 * @property string $tarikh_khidmat
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $status_temujanji
 * @property string $catitan_ringkas
 */
class TemujanjiKomplimentari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_temujanji_komplimentari';
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
            [['atlet_id','jantina', 'jenis_sukan', 'perkhidmatan', 'tarikh_khidmat','lokasi', 'pegawai_yang_bertanggungjawab', 'status_temujanji'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_khidmat'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
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
            'temujanji_komplimentari_id' => 'Temujanji Komplimentari ID',
            'atlet_id' => 'Atlet',
            'jantina' => 'Jantina',
            'jenis_sukan' => 'Jenis Sukan',
            'perkhidmatan' => 'Perkhidmatan',
            'tarikh_khidmat' => 'Tarikh Khidmat',
            'lokasi' => 'Lokasi',
            'pegawai_yang_bertanggungjawab' => 'Juru Urut Yang Bertanggungjawab',
            'status_temujanji' => 'Status Temujanji',
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
    public function getRefPerkhidmatanKomplimentari(){
        return $this->hasOne(RefPerkhidmatanKomplimentari::className(), ['id' => 'perkhidmatan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJuruUrut(){
        return $this->hasOne(RefJuruUrut::className(), ['id' => 'pegawai_yang_bertanggungjawab']);
    }
}
