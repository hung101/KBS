<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatPegawaiTeknikal;

/**
 * MaklumatPegawaiTeknikalSearch represents the model behind the search form about `app\models\MaklumatPegawaiTeknikal`.
 */
class MaklumatPegawaiTeknikalSearch extends MaklumatPegawaiTeknikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id', 'bantuan_penganjuran_kursus_pegawai_teknikal_id', 'umur', 'created_by', 'updated_by'], 'integer'],
            [['badan_sukan', 'sukan', 'nama', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_kad_pengenalan', 'no_passport', 'jantina', 'no_telefon', 'alamat_e_mail', 'tahap_akademik', 'tahap_kelayakan_sukan_peringkat_kebangsaan', 'tahap_kelayakan_sukan_peringkat_antarabangsa', 'nama_majikan', 'no_telefon_majikan', 'no_faks', 'jawatan', 'gred', 'nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = MaklumatPegawaiTeknikal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id,
            'bantuan_penganjuran_kursus_pegawai_teknikal_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_id,
            'umur' => $this->umur,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'badan_sukan', $this->badan_sukan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_passport', $this->no_passport])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'alamat_e_mail', $this->alamat_e_mail])
            ->andFilterWhere(['like', 'tahap_akademik', $this->tahap_akademik])
            ->andFilterWhere(['like', 'tahap_kelayakan_sukan_peringkat_kebangsaan', $this->tahap_kelayakan_sukan_peringkat_kebangsaan])
            ->andFilterWhere(['like', 'tahap_kelayakan_sukan_peringkat_antarabangsa', $this->tahap_kelayakan_sukan_peringkat_antarabangsa])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'no_telefon_majikan', $this->no_telefon_majikan])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'gred', $this->gred])
            ->andFilterWhere(['like', 'nama_kejohanan_kursus', $this->nama_kejohanan_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
