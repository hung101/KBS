<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SenaraiHargaPerkhidmatanUbatanPeralatan;

/**
 * SenaraiHargaPerkhidmatanUbatanPeralatanSearch represents the model behind the search form about `app\models\SenaraiHargaPerkhidmatanUbatanPeralatan`.
 */
class SenaraiHargaPerkhidmatanUbatanPeralatanSearch extends SenaraiHargaPerkhidmatanUbatanPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_harga_perkhidmatan_ubatan_peralatan_id'], 'integer'],
            [['nama_perkhidmatan_ubatan_peralatan', 'catitan_ringkas'], 'safe'],
            [['harga'], 'number'],
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
        $query = SenaraiHargaPerkhidmatanUbatanPeralatan::find();

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
            'senarai_harga_perkhidmatan_ubatan_peralatan_id' => $this->senarai_harga_perkhidmatan_ubatan_peralatan_id,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['like', 'nama_perkhidmatan_ubatan_peralatan', $this->nama_perkhidmatan_ubatan_peralatan])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas]);

        return $dataProvider;
    }
}
