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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_jurulatih', 'nilai'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'nama_jurulatih', 'created_by', 'updated_by'], 'integer'],
            [['nilai'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
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
        ];
    }
    
    /**
     * Validate nilai can more that SGAR % from total value
     */
    public function validateNilai($attribute, $params){
        $session = new Session;
        $session->open();
        $nilai = 0;
        $jumlah_insentif_allocated = 0;
        
        if(isset($session['acara_id'])){
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
        
        $session->close();
        
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
        
        if($nilai < ($jumlah_insentif_allocated + $this->nilai)){
            if(($nilai-$jumlah_insentif_allocated) < 1){
                $this->addError($attribute, "Semua insentif SGAR telah diperuntukkan");
            } else {
                $this->addError($attribute, "Nilai yang boleh diperuntukkan tidak boleh lebih daripada RM " . ($nilai-$jumlah_insentif_allocated));
            }
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'nama_jurulatih']);
    }
}
