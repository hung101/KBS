<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPakaian;

/**
 * AtletPakaianSearch represents the model behind the search form about `app\models\AtletPakaian`.
 */
class AtletPakaianSearch extends AtletPakaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pakaian_id', 'atlet_id'], 'integer'],
            [['jenis_pakaian', 'saiz_pakaian'], 'safe'],
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
        $query = AtletPakaian::find()
                ->joinWith(['refJenisPakaian'])
                ->joinWith(['refSaizPakaian']);

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
            'pakaian_id' => $this->pakaian_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_pakaian.desc', $this->jenis_pakaian])
            ->andFilterWhere(['like', 'tbl_ref_saiz_pakaian.desc', $this->saiz_pakaian]);

        return $dataProvider;
    }
}
