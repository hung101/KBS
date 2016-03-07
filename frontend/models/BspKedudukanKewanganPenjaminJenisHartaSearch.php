<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspKedudukanKewanganPenjaminJenisHarta;

/**
 * BspKedudukanKewanganPenjaminJenisHartaSearch represents the model behind the search form about `app\models\BspKedudukanKewanganPenjaminJenisHarta`.
 */
class BspKedudukanKewanganPenjaminJenisHartaSearch extends BspKedudukanKewanganPenjaminJenisHarta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_kedudukan_kewangan_penjamin_jenis_harta_id', 'bsp_kedudukan_kewangan_penjamin_id', 'jumlah_ekar_kaki_persegi'], 'integer'],
            [['jenis_harta', 'session_id'], 'safe'],
            [['nilai'], 'number'],
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
        $query = BspKedudukanKewanganPenjaminJenisHarta::find()
                ->joinWith(['refJenisHarta']);

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
            'bsp_kedudukan_kewangan_penjamin_jenis_harta_id' => $this->bsp_kedudukan_kewangan_penjamin_jenis_harta_id,
            'bsp_kedudukan_kewangan_penjamin_id' => $this->bsp_kedudukan_kewangan_penjamin_id,
            'jumlah_ekar_kaki_persegi' => $this->jumlah_ekar_kaki_persegi,
            'nilai' => $this->nilai,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_harta.desc', $this->jenis_harta])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
