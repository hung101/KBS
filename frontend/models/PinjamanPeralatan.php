<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pinjaman_peralatan".
 *
 * @property integer $pinjaman_peralatan_id
 * @property integer $atlet_id
 * @property string $nama_peralatan
 * @property integer $kuantiti
 * @property string $tarikh_diberi
 * @property string $tarikh_dipulang
 * @property string $tempoh_pinjaman
 */
class PinjamanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pinjaman_peralatan';
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
            [['atlet_id', 'nama_peralatan', 'kuantiti', 'tarikh_diberi'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kuantiti'], 'integer'],
            //[['tarikh_diberi'], 'safe'],
            [['nama_peralatan'], 'string', 'max' => 80],
            [['tempoh_pinjaman'], 'string', 'max' => 50],
            [['tarikh_dipulang'], 'compare', 'compareAttribute'=>'tarikh_diberi', 'operator'=>'>='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pinjaman_peralatan_id' => GeneralLabel::pinjaman_peralatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'kuantiti' => GeneralLabel::kuantiti,
            'tarikh_diberi' => GeneralLabel::tarikh_diberi,
            'tarikh_dipulang' => GeneralLabel::tarikh_dipulang,
            'tempoh_pinjaman' => GeneralLabel::tempoh_pinjaman,

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
    public function getRefPeralatanPinjaman(){
        return $this->hasOne(RefPeralatanPinjaman::className(), ['id' => 'nama_peralatan']);
    }
}
