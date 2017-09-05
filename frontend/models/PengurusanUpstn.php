<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_upstn".
 *
 * @property integer $pengurusan_upstn_id
 * @property string $nama_pengurus_sukan
 * @property string $nama_sukan
 * @property string $tarikh_lawatan
 * @property string $masa
 * @property string $tempat
 * @property string $kehadiran
 * @property string $isu
 * @property string $ulasan
 */
class PengurusanUpstn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_upstn';
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
            [['nama_pengurus_sukan', 'nama_sukan', 'tarikh_lawatan', 'tempat', 'kehadiran', 'isu', 'negeri', 'l_melayu', 'l_cina',
                'l_india', 'l_lain_lain', 'w_melayu', 'w_cina', 'w_india', 'w_lain_lain', 'u12_lelaki', 'u12_wanita', 'u15_lelaki',
                'u15_wanita', 'u18_lelaki', 'u18_wanita', 'u21_lelaki', 'u21_wanita'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama_pengurus_sukan', 'tarikh_lawatan', 'masa', 'negeri', 'tempat', 'nama_sukan'], 'safe'],
            [['l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'w_melayu', 'w_cina', 'w_india', 'w_lain_lain', 'u12_lelaki', 'u12_wanita', 'u15_lelaki',
                'u15_wanita', 'u18_lelaki', 'u18_wanita', 'u21_lelaki', 'u21_wanita'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['nama_sukan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kehadiran', 'isu', 'ulasan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kehadiran', 'isu', 'ulasan'], function ($attribute, $params) {
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
            'pengurusan_upstn_id' => GeneralLabel::pengurusan_upstn_id,
            'nama_pengurus_sukan' => GeneralLabel::nama_ppn,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'tarikh_lawatan' => GeneralLabel::tarikh_pemantauan,
            'masa' => GeneralLabel::masa,
            'tempat' => GeneralLabel::pusat_latihan,
            'kehadiran' => GeneralLabel::kehadiran,
            'isu' => GeneralLabel::isu,
            'ulasan' => GeneralLabel::ulasan,
            'negeri' => GeneralLabel::negeri,
            'l_melayu' => GeneralLabel::melayu,
            'l_cina' => GeneralLabel::cina,
            'l_india' => GeneralLabel::india,
            'l_lain_lain' => GeneralLabel::lain_lain,
            'w_melayu' => GeneralLabel::melayu,
            'w_cina' => GeneralLabel::cina,
            'w_india' => GeneralLabel::india,
            'w_lain_lain' => GeneralLabel::lain_lain,
            'u12_lelaki' => GeneralLabel::lelaki,
            'u12_wanita' => GeneralLabel::wanita,
            'u15_lelaki' => GeneralLabel::lelaki,
            'u15_wanita' => GeneralLabel::wanita,
            'u18_lelaki' => GeneralLabel::lelaki,
            'u18_wanita' => GeneralLabel::wanita,
            'u21_lelaki' => GeneralLabel::lelaki,
            'u21_wanita' => GeneralLabel::wanita,
            
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPpn(){
        return $this->hasOne(User::className(), ['id' => 'nama_pengurus_sukan']);
    }
}
