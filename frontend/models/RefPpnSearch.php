<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefPpn;

/**
 * RefPpnSearch represents the model behind the search form about `app\models\RefPpn`.
 */
class RefPpnSearch extends RefPpn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif', 'created_by', 'updated_by', 'no_kad_pengenalan'], 'integer'],
            [['desc', 'created', 'updated', 'sukan', 'negeri', 'jawatan'], 'safe'],
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
        $query = RefPpn::find()
                ->joinWith(['refNegeri'])
                ->joinWith(['refSukan']);

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
            'id' => $this->id,
            'aktif' => $this->aktif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
                ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
                ->andFilterWhere(['like', 'jawatan', $this->jawatan])
                ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan]);

        return $dataProvider;
    }
}
