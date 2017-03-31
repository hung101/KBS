<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_maklumat_akademik".
 *
 * @property integer $maklumat_akademik_id
 * @property integer $atlet
 * @property integer $sukan
 * @property integer $program
 * @property string $no_matrik
 * @property string $fakulti
 * @property string $atlet_no_tel
 * @property string $atlet_hp_no
 * @property string $penasihat_akademik
 * @property string $penasihat_no_tel
 * @property string $penasihat_hp_no
 * @property string $semester
 * @property integer $jumlah_semester
 * @property integer $jumlah_tahun
 * @property integer $tahun_kemasukan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class MaklumatAkademik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_akademik';
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
		    [['atlet', 'sukan', 'program'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet', 'sukan', 'program', 'jumlah_semester', 'jumlah_tahun', 'tahun_kemasukan', 'created_by', 'updated_by', 'atlet_no_tel', 'atlet_hp_no', 'penasihat_no_tel', 'penasihat_hp_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['no_matrik'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['fakulti', 'penasihat_akademik'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['semester'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maklumat_akademik_id' => 'Maklumat Akademik ID',
            'atlet' => GeneralLabel::atlet,
            'sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'no_matrik' => GeneralLabel::no_matrix,
            'fakulti' => GeneralLabel::fakulti,
            'atlet_no_tel' => GeneralLabel::tel_no,
            'atlet_hp_no' => GeneralLabel::hp_no,
            'penasihat_akademik' => GeneralLabel::nama_penasihat_akademik,
            'penasihat_no_tel' => GeneralLabel::tel_no,
            'penasihat_hp_no' => GeneralLabel::hp_no,
            'semester' => GeneralLabel::semester,
            'jumlah_semester' => GeneralLabel::jumlah_semester,
            'jumlah_tahun' => GeneralLabel::jumlah_tahun,
            'tahun_kemasukan' => GeneralLabel::tahun_kemasukan,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
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
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
    }
}
