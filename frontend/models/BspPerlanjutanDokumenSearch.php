<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPerlanjutanDokumen;

/**
 * BspPerlanjutanDokumenSearch represents the model behind the search form about `app\models\BspPerlanjutanDokumen`.
 */
class BspPerlanjutanDokumenSearch extends BspPerlanjutanDokumen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_perlanjutan_dokumen_id', 'bsp_perlanjutan_id'], 'integer'],
            [['nama_dokumen', 'upload', 'session_id'], 'safe'],
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
        $query = BspPerlanjutanDokumen::find();

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
            'bsp_perlanjutan_dokumen_id' => $this->bsp_perlanjutan_dokumen_id,
            'bsp_perlanjutan_id' => $this->bsp_perlanjutan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'upload', $this->upload])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
