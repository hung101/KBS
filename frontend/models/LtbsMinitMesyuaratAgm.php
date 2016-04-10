<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ltbs_minit_mesyuarat_agm".
 *
 * @property integer $mesyuarat_agm_id
 * @property string $tarikh
 * @property string $masa
 * @property string $tempat
 * @property integer $jumlah_ahli_yang_hadir
 * @property integer $jumlah_ahli_yang_layak_mengundi
 * @property string $agenda_mesyuarat
 * @property string $keputusan_mesyuarat
 */
class LtbsMinitMesyuaratAgm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_minit_mesyuarat_agm';
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
            [['tarikh', 'tempat', 'jumlah_ahli_yang_hadir', 'jumlah_ahli_yang_layak_mengundi', 'agenda_mesyuarat', 'keputusan_mesyuarat'], 'required', 'skipOnEmpty' => true],
            [['tarikh', 'masa'], 'safe'],
            [['jumlah_ahli_yang_hadir', 'jumlah_ahli_yang_layak_mengundi'], 'integer'],
            [['tempat'], 'string', 'max' => 30],
            [['agenda_mesyuarat', 'keputusan_mesyuarat'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mesyuarat_agm_id' => GeneralLabel::mesyuarat_agm_id,
            'tarikh' => GeneralLabel::tarikh,
            'masa' => GeneralLabel::masa,
            'tempat' => GeneralLabel::tempat,
            'jumlah_ahli_yang_hadir' => GeneralLabel::jumlah_ahli_yang_hadir,
            'jumlah_ahli_yang_layak_mengundi' => GeneralLabel::jumlah_ahli_yang_layak_mengundi,
            'agenda_mesyuarat' => GeneralLabel::agenda_mesyuarat,
            'keputusan_mesyuarat' => GeneralLabel::keputusan_mesyuarat,

        ];
    }
}
