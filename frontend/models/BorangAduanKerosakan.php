<?php

namespace app\models;

use Yii;

// contant values
use app\models\general\Placeholder;
use app\models\general\GeneralLabel;
use app\models\general\GeneralVariable;
use common\models\general\GeneralFunction;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_aduan_kerosakan".
 *
 * @property integer $borang_aduan_kerosakan_id
 * @property integer $penyelia
 * @property string $jawatan
 * @property string $tarikh
 * @property integer $venue
 * @property integer $bahagian
 * @property string $no_tel_pejabat
 * @property string $no_tel_bimbit
 * @property string $kawasan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BorangAduanKerosakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_aduan_kerosakan';
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
            [['penyelia', 'venue', 'bahagian', 'created_by', 'updated_by', 'kawasan'], 'integer'],
            [['tarikh', 'created', 'updated', 'tarikh_siap_tindakan'], 'safe'],
            [['jawatan'], 'string', 'max' => 80],
            [['no_tel_pejabat', 'no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_pejabat', 'no_tel_bimbit'], 'string', 'max' => 14],
            [['jawatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_aduan_kerosakan_id' => 'Borang Aduan Kerosakan ID',
            'penyelia' => GeneralLabel::penyelia,  //'Penyelia',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'tarikh' => GeneralLabel::tarikh,  //'Tarikh',
            'venue' => GeneralLabel::venue,  //'Venue',
            'bahagian' => GeneralLabel::bahagian,  //'Bahagian',
            'no_tel_pejabat' => GeneralLabel::no_tel_pejabat,  //'No Tel Pejabat',
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,  //'No Tel Bimbit',
            'kawasan' => GeneralLabel::kawasan,  //'Kawasan',
            'tarikh_siap_tindakan' => GeneralLabel::tarikh_siap_tindakan,  //'Tarikh Siap Tindakan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanPenyelia(){
        return $this->hasOne(PengurusanPenyelia::className(), ['id' => 'penyelia']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefVenueAduan(){
        return $this->hasOne(RefVenueAduan::className(), ['id' => 'venue']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKawasanKemudahan(){
        return $this->hasOne(RefKawasanKemudahan::className(), ['id' => 'kawasan']);
    }
    
}
