<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_insentif_tetapan_shakam_shakar".
 *
 * @property integer $pengurusan_insentif_tetapan_shakam_shakar_id
 * @property integer $pengurusan_insentif_tetapan_id
 * @property integer $jenis_insentif
 * @property integer $pingat
 * @property string $kumpulan_temasya_kejohanan
 * @property integer $rekod_baharu
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanInsentifTetapanShakamShakar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insentif_tetapan_shakam_shakar';
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
            [['jenis_insentif', 'pingat', 'rekod_baharu', 'kumpulan_temasya_kejohanan', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_insentif_tetapan_id', 'jenis_insentif', 'pingat', 'rekod_baharu', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['kumpulan_temasya_kejohanan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insentif_tetapan_shakam_shakar_id' => 'Pengurusan Insentif Tetapan Shakam Shakar ID',
            'pengurusan_insentif_tetapan_id' => 'Pengurusan Insentif Tetapan ID',
            'jenis_insentif' => GeneralLabel::jenis_insentif,
            'pingat' => GeneralLabel::pingat,
            'kumpulan_temasya_kejohanan' => GeneralLabel::kumpulan_temasya_kejohanan,
            'rekod_baharu' => GeneralLabel::rekod_baharu,
            'jumlah' => GeneralLabel::jumlah,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisInsentif(){
        return $this->hasOne(RefJenisInsentif::className(), ['id' => 'jenis_insentif']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPingatInsentif(){
        return $this->hasOne(RefPingatInsentif::className(), ['id' => 'pingat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'rekod_baharu']);
    }
}
