<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanProgramPendidikanKesihatan;

/**
 * PermohonanProgramPendidikanKesihatanSearch represents the model behind the search form about `app\models\PermohonanProgramPendidikanKesihatan`.
 */
class PermohonanProgramPendidikanKesihatanSearch extends PermohonanProgramPendidikanKesihatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_program_pendidikan_kesihatan_id'], 'integer'],
            [['nama_program', 'tarikh_program', 'tempat_program', 'nama_pemohon', 'no_tel_pemohon', 'pegawai_bertugas', 'muat_naik', 'kelulusan_ceo', 'kelulusan_pbu'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PermohonanProgramPendidikanKesihatan::find()
                ->joinWith(['refKelulusanCEO' => function($query) { $query->from('tbl_ref_kelulusan rkceo');}])
                ->joinWith(['refKelulusanPBU' => function($query) { $query->from('tbl_ref_kelulusan rkpbu');}]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'permohonan_program_pendidikan_kesihatan_id' => $this->permohonan_program_pendidikan_kesihatan_id,
            'tarikh_program' => $this->tarikh_program,
            //'kelulusan_ceo' => $this->kelulusan_ceo,
            //'kelulusan_pbu' => $this->kelulusan_pbu,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'tempat_program', $this->tempat_program])
            ->andFilterWhere(['like', 'nama_pemohon', $this->nama_pemohon])
            ->andFilterWhere(['like', 'no_tel_pemohon', $this->no_tel_pemohon])
            ->andFilterWhere(['like', 'pegawai_bertugas', $this->pegawai_bertugas])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'rkceo.desc', $this->kelulusan_ceo])
                ->andFilterWhere(['like', 'rkpbu.desc', $this->kelulusan_pbu]);

        return $dataProvider;
    }
}
