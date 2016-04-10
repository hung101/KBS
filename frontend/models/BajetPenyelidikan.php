<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bajet_penyelidikan".
 *
 * @property integer $bajet_penyelidikan_id
 * @property integer $permohonana_penyelidikan_id
 * @property string $jenis_bajet
 * @property string $tahun_1
 * @property string $jumlah
 */
class BajetPenyelidikan extends \yii\db\ActiveRecord
{
    public $jenis_bajet_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bajet_penyelidikan';
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
            [['jenis_bajet', 'tahun_1','tahun_2','tahun_3'], 'required', 'skipOnEmpty' => true],
            [['permohonana_penyelidikan_id', 'jenis_bajet'], 'integer'],
            [['jumlah','tahun_1','tahun_2','tahun_3'], 'number'],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bajet_penyelidikan_id' => GeneralLabel::bajet_penyelidikan_id,
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'jenis_bajet' => GeneralLabel::jenis_bajet,
            'tahun_1' => GeneralLabel::tahun_1,
            'tahun_2' => GeneralLabel::tahun_2,
            'tahun_3' => GeneralLabel::tahun_3,
            'jumlah' => GeneralLabel::jumlah,
            'catatan' => GeneralLabel::catatan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisBajet(){
        return $this->hasOne(RefJenisBajet::className(), ['id' => 'jenis_bajet']);
    }
}
