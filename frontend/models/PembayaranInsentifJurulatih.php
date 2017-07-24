<?php

namespace app\models;

use Yii;
use yii\web\Session;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_insentif_jurulatih".
 *
 * @property integer $pembayaran_pembayaran_insentif_jurulatih_id
 * @property integer $pembayaran_insentif_id
 * @property integer $nama_jurulatih
 * @property string $nilai
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranInsentifJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_insentif_jurulatih';
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
            [['nama_jurulatih', 'nilai', 'sukan', 'pembayaran_kepada'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'nama_jurulatih', 'created_by', 'updated_by', 'nama_bank', 'no_akaun_bank'], 'integer'],
            [['nilai'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            [['no_akaun_bank'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nilai'], 'validateNilai', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_pembayaran_insentif_jurulatih_id' => 'Pembayaran Pembayaran Insentif Jurulatih ID',
            'pembayaran_insentif_id' => 'Pembayaran Insentif ID',
            'nama_jurulatih' => GeneralLabel::nama_jurulatih,
            'nilai' => GeneralLabel::nilai,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'sukan' => GeneralLabel::sukan,
            'pembayaran_kepada' => GeneralLabel::pembayaran_kepada,
            'nama_bank' => GeneralLabel::nama_bank,
            'no_akaun_bank' => GeneralLabel::no_akaun_bank,
        ];
    }
    
    /**
     * Validate nilai can more that SGAR % from total value
     */
    public function validateNilai($attribute, $params){
        $session = new Session;
        $session->open();
        $jumlah_insentif_allocated_atlet = 0;
        $jumlah_insentif_allocated_jurulatih_max = 0;
        $jumlah_insentif_allocated = 0;
        
        /*if(isset($session['acara_id'])){
            if($session['acara_id'] == RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG || $session['acara_id'] == RefAcaraInsentif::BERPASUKAN_LEBIH_5_ORANG){
                if(isset($session['nilai_SGAR_berpasukan'])){
                    $nilai = $session['nilai_SGAR_berpasukan'];
                }
            }else if($session['acara_id'] == RefAcaraInsentif::INDIVIDU){
                if(isset($session['nilai_SGAR_individu'])){
                    $nilai = $session['nilai_SGAR_individu'];
                }
            }
        }
        
        if($this->pembayaran_insentif_id != null or $this->pembayaran_insentif_id != ""){
            if (($modelPembayaranInsentif = PembayaranInsentif::findOne($this->pembayaran_insentif_id)) !== null) {
                $nilai = $modelPembayaranInsentif->jumlah;
            }
        }*/
        
        $session->close();
        
        // calculate total insentif allocated to atlets
        $modelInsentifAtlet= null;
        
        if($this->pembayaran_insentif_id != null or $this->pembayaran_insentif_id != ""){
            $modelInsentifAtlet = PembayaranInsentifAtlet::find()->where(['pembayaran_insentif_id'=>$this->pembayaran_insentif_id])->all();
        } else if($this->session_id != null or $this->session_id != ""){
            $modelInsentifAtlet = PembayaranInsentifAtlet::find()->where(['session_id'=>$this->session_id])->all();
        }
        
        if($modelInsentifAtlet){
            foreach($modelInsentifAtlet as $insentifAtlet){
                $jumlah_insentif_allocated_atlet += $insentifAtlet->nilai;
            }
        }
        
        $jumlah_insentif_allocated_jurulatih_max = ($jumlah_insentif_allocated_atlet*0.2); // 20% from total allocated to atlets 
        
        
        // calculate total insentif allocated to jurulatih dan overall cannot more than 20% from total allocated to atlets
        $modelInsentifJurulatih = null;
        
        if($this->pembayaran_insentif_id != null or $this->pembayaran_insentif_id != ""){
            $modelInsentifJurulatih = PembayaranInsentifJurulatih::find()->where(['pembayaran_insentif_id'=>$this->pembayaran_insentif_id])->all();
        } else if($this->session_id != null or $this->session_id != ""){
            $modelInsentifJurulatih = PembayaranInsentifJurulatih::find()->where(['session_id'=>$this->session_id])->all();
        }
        
        if($modelInsentifJurulatih){
            foreach($modelInsentifJurulatih as $insentifJurulatih){
                $jumlah_insentif_allocated += $insentifJurulatih->nilai;
            }
        }
        
        $jumlah_insentif_allocated -= $this->getOldAttribute('nilai');
        
        if($jumlah_insentif_allocated_jurulatih_max < ($jumlah_insentif_allocated + $this->nilai)){
            if(($jumlah_insentif_allocated_jurulatih_max-$jumlah_insentif_allocated) < 1){
                $this->addError($attribute, "Semua insentif SGAR telah diperuntukkan");
            } else {
                $this->addError($attribute, "Nilai yang boleh diperuntukkan tidak boleh lebih daripada RM " . ($jumlah_insentif_allocated_jurulatih_max-$jumlah_insentif_allocated));
            }
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
