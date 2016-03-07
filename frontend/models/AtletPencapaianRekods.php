<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_pencapaian_rekods".
 *
 * @property integer $pencapaian_rekods_id
 * @property integer $pencapaian_id
 * @property string $tarikh
 * @property string $peringkat
 * @property string $opponent
 * @property string $result
 * @property string $venue
 * @property string $personal_best
 * @property string $season_best
 */
class AtletPencapaianRekods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian_rekods';
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
            [['tarikh', 'peringkat', 'opponent', 'jenis_rekod', 'result'], 'required', 'skipOnEmpty' => true],
            [['pencapaian_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['peringkat'], 'string', 'max' => 30],
            [['opponent'], 'string', 'max' => 80],
            [['result', 'personal_best', 'season_best'], 'string', 'max' => 100],
            [['venue'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pencapaian_rekods_id' => 'Pencapaian Rekods ID',
            'pencapaian_id' => 'Pencapaian ID',
            'tarikh' => 'Tarikh',
            'peringkat' => 'Peringkat',
            'opponent' => 'Opponent',
            'jenis_rekod' => 'Jenis Rekod',
            'result' => 'Keputusan',
            'venue' => 'Venue',
            'personal_best' => 'Personal Best',
            'season_best' => 'Season Best',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisRekod(){
        return $this->hasOne(RefJenisRekod::className(), ['id' => 'jenis_rekod']);
    }
}
