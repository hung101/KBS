<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangProfilPesertaKpskPeserta;

/**
 * BorangProfilPesertaKpskPesertaSearch represents the model behind the search form about `app\models\BorangProfilPesertaKpskPeserta`.
 */
class BorangProfilPesertaKpskPesertaSearch extends BorangProfilPesertaKpskPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_profil_peserta_kpsk_peserta_id', 'borang_profil_peserta_kpsk_id', 'umur', 'bangsa', 'agama', 'akademik', 'keputusan', 'objektif', 'struktur', 'esei', 'jumlah', 'created_by', 'updated_by'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'no_telefon_bimbit', 'emel', 'facebook', 'pekerjaan', 'nama_majikan', 'catatan', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = BorangProfilPesertaKpskPeserta::find();

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
            'borang_profil_peserta_kpsk_peserta_id' => $this->borang_profil_peserta_kpsk_peserta_id,
            'borang_profil_peserta_kpsk_id' => $this->borang_profil_peserta_kpsk_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'umur' => $this->umur,
            'bangsa' => $this->bangsa,
            'agama' => $this->agama,
            'akademik' => $this->akademik,
            'keputusan' => $this->keputusan,
            'objektif' => $this->objektif,
            'struktur' => $this->struktur,
            'esei' => $this->esei,
            'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'no_telefon_bimbit', $this->no_telefon_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
