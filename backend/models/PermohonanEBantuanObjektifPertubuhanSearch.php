<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanObjektifPertubuhan;

/**
 * PermohonanEBantuanObjektifPertubuhanSearch represents the model behind the search form about `app\models\PermohonanEBantuanObjektifPertubuhan`.
 */
class PermohonanEBantuanObjektifPertubuhanSearch extends PermohonanEBantuanObjektifPertubuhan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objektif_pertubuhan_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['objektif', 'session_id'], 'safe'],
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
        $query = PermohonanEBantuanObjektifPertubuhan::find();

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
            'objektif_pertubuhan_id' => $this->objektif_pertubuhan_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
        ]);

        $query->andFilterWhere(['like', 'objektif', $this->objektif])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
