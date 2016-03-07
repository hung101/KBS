<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanKomposisiPenyertaan;

/**
 * ElaporanKomposisiPenyertaanSearch represents the model behind the search form about `app\models\ElaporanKomposisiPenyertaan`.
 */
class ElaporanKomposisiPenyertaanSearch extends ElaporanKomposisiPenyertaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_komposisi_penyertaan_id', 'elaporan_pelaksaan_id', 'bilangan'], 'integer'],
            [['kumpulan_penyertaan', 'jenis_komposisi'], 'safe'],
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
        $query = ElaporanKomposisiPenyertaan::find();

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
            'elaporan_komposisi_penyertaan_id' => $this->elaporan_komposisi_penyertaan_id,
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
            'bilangan' => $this->bilangan,
        ]);

        $query->andFilterWhere(['like', 'kumpulan_penyertaan', $this->kumpulan_penyertaan])
            ->andFilterWhere(['like', 'jenis_komposisi', $this->jenis_komposisi]);

        return $dataProvider;
    }
}
