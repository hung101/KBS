<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_pendidikan_keputusan_spm".
 *
 * @property integer $permohonan_pendidikan_keputusan_spm_id
 * @property integer $permohonan_pendidikan_id
 * @property integer $subjek
 * @property string $keputusan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanPendidikanKeputusanSpm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_pendidikan_keputusan_spm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_pendidikan_id', 'subjek', 'created_by', 'updated_by'], 'integer'],
            [['subjek', 'keputusan'], 'required'],
            [['created', 'updated'], 'safe'],
            [['keputusan'], 'string', 'max' => 20],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_pendidikan_keputusan_spm_id' => 'Permohonan Pendidikan Keputusan Spm ID',
            'permohonan_pendidikan_id' => 'Permohonan Pendidikan ID',
            'subjek' => 'Subjek',
            'keputusan' => 'Keputusan',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
