<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_user_peranan".
 *
 * @property integer $user_peranan_id
 * @property string $nama_peranan
 * @property string $peranan_akses
 * @property integer $aktif
 */
class UserPeranan extends \yii\db\ActiveRecord
{
    public $msn;
    public $isn;
    public $pjs;
    public $kbs;
    
    const PERANAN_ADMIN = 3;
    const PERANAN_PJS_PERSATUAN = 6;
    const PERANAN_KBS_E_BIASISWA_BENDAHARI_IPT = 7;
    const PERANAN_KBS_E_BANTUAN_URUSETIA = 8;
    const PERANAN_MSN_ADUAN_PENYELIA = 9;
    const PERANAN_MSN_PENGURUS_SUKAN = 10;
    const PERANAN_MSN_MAJLIS_SUKAN_NEGERI = 11;
    const PERANAN_MSN_PPN = 234;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_peranan';
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
            [['nama_peranan', 'peranan_akses', 'aktif'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['peranan_akses'], 'safe'],
            [['aktif'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_peranan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agensi'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_peranan', 'agensi'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_peranan_id' => GeneralLabel::user_peranan_id,
            'nama_peranan' => GeneralLabel::nama_peranan,
            'peranan_akses' => GeneralLabel::peranan_akses,
            'aktif' => GeneralLabel::aktif,
            'agensi' => GeneralLabel::penapis_agensi,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'aktif']);
    }
}
