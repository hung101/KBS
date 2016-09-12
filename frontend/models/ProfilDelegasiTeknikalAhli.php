<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_delegasi_teknikal_ahli".
 *
 * @property integer $profil_delegasi_teknikal_ahli_id
 * @property integer $profil_delegasi_teknikal_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $tarikh_lahir
 * @property integer $umur
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $jawatan
 * @property string $no_telefon_bimbit
 * @property string $emel
 * @property string $pekerjaan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $no_telefon_pejabat
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilDelegasiTeknikalAhli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_delegasi_teknikal_ahli';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_delegasi_teknikal_ahli_id', 'umur', 'created_by', 'updated_by'], 'integer'],
            [['jantina', 'tarikh_lahir', 'created', 'updated'], 'safe'],
            [['nama', 'jawatan', 'pekerjaan', 'jawatan_lain_lain'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 30],
            [['alamat_negeri', 'alamat_majikan_negeri'], 'string', 'max' => 3],
            [['alamat_bandar', 'alamat_poskod', 'alamat_majikan_bandar', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['no_telefon_bimbit', 'no_telefon_pejabat'], 'string', 'max' => 14],
            [['emel', 'session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_delegasi_teknikal_ahli_id' => 'Profil Delegasi Teknikal Ahli ID',
            'profil_delegasi_teknikal_id' => 'Profil Delegasi Teknikal ID',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'jantina' => 'Jantina',
            'tarikh_lahir' => 'Tarikh Lahir',
            'umur' => 'Umur',
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'jawatan' => 'Jawatan',
            'no_telefon_bimbit' => 'No Telefon Bimbit',
            'emel' => 'E-mel',
            'pekerjaan' => 'Pekerjaan',
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_poskod,
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'jawatan_lain_lain'=> 'Nyatakan Jawatan (Jika Lain-lain)',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanDelegasiTeknikal(){
        return $this->hasOne(RefJawatanDelegasiTeknikal::className(), ['id' => 'jawatan']);
    }
}
