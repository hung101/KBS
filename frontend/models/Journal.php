<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_journal".
 *
 * @property integer $journal_id
 * @property string $nama_penulis
 * @property string $telefon_no
 * @property string $emel
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $tarikh_journal
 * @property string $bahagian
 * @property string $artikel_journal
 * @property string $status_journal
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_journal';
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
            [['nama_penulis', 'telefon_no', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tarikh_journal', 'bahagian', 'artikel_journal'], 'required', 'skipOnEmpty' => true],
            [['tarikh_journal'], 'safe'],
            [['artikel_journal'], 'string'],
            [['nama_penulis'], 'string', 'max' => 80],
            [['telefon_no'], 'string', 'max' => 14],
            [['emel'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'bahagian', 'status_journal'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_id' => 'Journal ID',
            'nama_penulis' => 'Nama Penulis',
            'telefon_no' => 'Telefon No',
            'emel' => 'Emel',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'tarikh_journal' => 'Tarikh Journal',
            'bahagian' => 'Bahagian',
            'artikel_journal' => 'Artikel Journal',
            'status_journal' => 'Status Journal',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusJournal(){
        return $this->hasOne(RefStatusJournal::className(), ['id' => 'status_journal']);
    }
}
