<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_delegasi_teknikal".
 *
 * @property integer $profil_delegasi_teknikal_id
 * @property string $temasya
 * @property string $negeri
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $sukan
 * @property string $peringkat
 * @property string $nama_badan_sukan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilDelegasiTeknikal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_delegasi_teknikal';
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
            [['temasya', 'negeri', 'tarikh_mula', 'tarikh_tamat', 'sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['temasya', 'peringkat', 'nama_badan_sukan'], 'string', 'max' => 80],
            [['negeri', 'alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['sukan'], 'string', 'max' => 90],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['alamat_negeri'], 'string', 'max' => 3],
            [['temasya', 'peringkat', 'nama_badan_sukan','negeri', 'alamat_bandar', 'alamat_poskod','sukan','alamat_1', 'alamat_2', 'alamat_3','alamat_negeri'], 'filter', 'filter' => function ($value) {
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
            'profil_delegasi_teknikal_id' => 'Profil Delegasi Teknikal ID',
            'temasya' => GeneralLabel::temasya, //'Temasya',
            'negeri' => GeneralLabel::negeri, //'Negeri',
            'tarikh_mula' => GeneralLabel::tarikh_mula, //'Tarikh Mula',
            'tarikh_tamat' => GeneralLabel::tarikh_tamat, //'Tarikh Tamat',
            'sukan' => GeneralLabel::sukan, //'Sukan',
            'peringkat' => GeneralLabel::peringkat, //'Peringkat',
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan, //'Nama Badan Sukan',
            'alamat_1' => GeneralLabel::alamat_persatuan,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanJawatankuasaKhasSukanMalaysia(){
        return $this->hasOne(PengurusanJawatankuasaKhasSukanMalaysia::className(), ['pengurusan_jawatankuasa_khas_sukan_malaysia_id' => 'temasya']);
    }
}
