<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KegiatanPengalamanJurulatihAkk;

/**
 * KegiatanPengalamanJurulatihAkkSearch represents the model behind the search form about `app\models\KegiatanPengalamanJurulatihAkk`.
 */
class KegiatanPengalamanJurulatihAkkSearch extends KegiatanPengalamanJurulatihAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kegiatan_pengalaman_jurulatih_akk_id', 'akademi_akk_id'], 'integer'],
            [['nama_sukan_pertandingan', 'tahun', 'peranan', 'peringkat', 'persatuan_sukan', 'session_id'], 'safe'],
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
        $query = KegiatanPengalamanJurulatihAkk::find()
                ->joinWith(['refPeringkatPengalamanJurulatih']);

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
            'kegiatan_pengalaman_jurulatih_akk_id' => $this->kegiatan_pengalaman_jurulatih_akk_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'nama_sukan_pertandingan', $this->nama_sukan_pertandingan])
            ->andFilterWhere(['like', 'peranan', $this->peranan])
                ->andFilterWhere(['like', 'peringkat', $this->peringkat])
            ->andFilterWhere(['like', 'persatuan_sukan', $this->persatuan_sukan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
