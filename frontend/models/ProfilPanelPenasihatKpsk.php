<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_panel_penasihat_kpsk".
 *
 * @property integer $profil_panel_penasihat_kpsk_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $emel
 * @property integer $tahap_akademik
 * @property string $nama_jurusan
 * @property string $pengkhususan
 * @property integer $silibus
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_telefon_majikan
 * @property string $no_faks
 * @property string $jawatan
 * @property string $gred
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilPanelPenasihatKpsk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_panel_penasihat_kpsk';
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
            [['nama', 'no_kad_pengenalan', 'jantina', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_poskod',
                'no_telefon', 'emel', 'tahap_akademik', 'nama_jurusan', 'pengkhususan', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_poskod', 'no_telefon_majikan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'created', 'updated'], 'safe'],
            [['tahap_akademik', 'silibus', 'created_by', 'updated_by', 'umur', 'no_kad_pengenalan'], 'integer'],
            [['nama', 'nama_jurusan', 'pengkhususan', 'nama_majikan', 'jawatan', 'gred'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['jantina'], 'string', 'max' => 1],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 30],
            [['alamat_negeri', 'alamat_majikan_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod', 'alamat_majikan_bandar', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['alamat_bandar', 'alamat_poskod', 'alamat_majikan_bandar', 'alamat_majikan_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'string', 'max' => 14],
            [['no_telefon', 'no_telefon_majikan', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'string', 'max' => 100],
            [['muatnaik'], 'string', 'max' => 255],
            [['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_panel_penasihat_kpsk_id' => 'Profil Panel Penasihat Kpsk ID',
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'jantina' => GeneralLabel::jantina,
            'umur' => GeneralLabel::umur,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_telefon' => GeneralLabel::no_telefon,
            'emel' => GeneralLabel::emel,
            'tahap_akademik' => GeneralLabel::tahap_akademik,
            'nama_jurusan' => GeneralLabel::nama_jurusan,
            'pengkhususan' => GeneralLabel::pengkhususan,
            'silibus' => GeneralLabel::silibus,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,
            'no_telefon_majikan' => GeneralLabel::no_telefon,
            'no_faks' => GeneralLabel::no_faks,
            'jawatan' => GeneralLabel::jawatan,
            'gred' => GeneralLabel::gred,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'muatnaik' => GeneralLabel::muatnaik,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
    }
}
