<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventori;

/**
 * InventoriSearch represents the model behind the search form about `app\models\Inventori`.
 */
class InventoriSearch extends Inventori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventori_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh', 'program', 'sukan', 'no_co', 'negeri', 'alamat_pembekal_1', 'alamat_pembekal_2', 'alamat_pembekal_3', 'alamat_pembekal_negeri', 'alamat_pembekal_bandar', 'alamat_pembekal_poskod', 'perkara', 'created', 'updated'], 'safe'],
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
        $query = Inventori::find()
                ->joinWith(['refNegeri']);

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
            'inventori_id' => $this->inventori_id,
            //'tarikh' => $this->tarikh,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'no_co', $this->no_co])
            ->andFilterWhere(['like', 'alamat_pembekal_1', $this->alamat_pembekal_1])
            ->andFilterWhere(['like', 'alamat_pembekal_2', $this->alamat_pembekal_2])
            ->andFilterWhere(['like', 'alamat_pembekal_3', $this->alamat_pembekal_3])
            ->andFilterWhere(['like', 'alamat_pembekal_negeri', $this->alamat_pembekal_negeri])
            ->andFilterWhere(['like', 'alamat_pembekal_bandar', $this->alamat_pembekal_bandar])
            ->andFilterWhere(['like', 'alamat_pembekal_poskod', $this->alamat_pembekal_poskod])
            ->andFilterWhere(['like', 'perkara', $this->perkara])
                ->andFilterWhere(['like', 'tarikh', $this->tarikh])
                ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri]);

        return $dataProvider;
    }
}
