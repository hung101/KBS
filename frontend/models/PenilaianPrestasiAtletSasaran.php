<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penilaian_prestasi_atlet_sasaran".
 *
 * @property integer $penilaian_prestasi_atlet_sasaran_id
 * @property integer $penilaian_pestasi_id
 * @property integer $atlet
 * @property string $sasaran
 * @property integer $keputusan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenilaianPrestasiAtletSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_prestasi_atlet_sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_pestasi_id', 'atlet', 'keputusan', 'created_by', 'updated_by'], 'integer'],
            [['atlet', 'sasaran'], 'required'],
            [['created', 'updated'], 'safe'],
            [['sasaran'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_prestasi_atlet_sasaran_id' => 'Penilaian Prestasi Atlet Sasaran ID',
            'penilaian_pestasi_id' => 'Penilaian Pestasi ID',
            'atlet' => 'Atlet',
            'sasaran' => 'Sasaran',
            'keputusan' => 'Keputusan',
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
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
}
