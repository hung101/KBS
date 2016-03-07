<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPerubatanDonator;

/**
 * AtletPerubatanDonatorSearch represents the model behind the search form about `app\models\AtletPerubatanDonator`.
 */
class AtletPerubatanDonatorSearch extends AtletPerubatanDonator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['donator_id', 'atlet_id'], 'integer'],
            [['no_donator_dokumen', 'jenis_organ'], 'safe'],
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
        $query = AtletPerubatanDonator::find()
                ->joinWith(['refJenisOrgan']);

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
            'donator_id' => $this->donator_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'no_donator_dokumen', $this->no_donator_dokumen])
            ->andFilterWhere(['like', 'tbl_ref_jenis_organ.desc', $this->jenis_organ]);

        return $dataProvider;
    }
}
