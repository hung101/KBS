<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahAhliJawantankuasaPemilihan;

/**
 * AnugerahAhliJawantankuasaPemilihanSearch represents the model behind the search form about `app\models\AnugerahAhliJawantankuasaPemilihan`.
 */
class AnugerahAhliJawantankuasaPemilihanSearch extends AnugerahAhliJawantankuasaPemilihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_ahli_jawantankuasa_pemilihan_id', 'created_by', 'updated_by'], 'integer'],
            [['perwakilan', 'nama', 'jawatan', 'created', 'updated'], 'safe'],
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
        $query = AnugerahAhliJawantankuasaPemilihan::find()
                ->joinWith(['refPerwakilan'])
                ->joinWith(['refJawatanJawatankuasaPemilihan']);

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
            'anugerah_ahli_jawantankuasa_pemilihan_id' => $this->anugerah_ahli_jawantankuasa_pemilihan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_perwakilan.desc', $this->perwakilan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_jawatan_jawatankuasa_pemilihan.desc', $this->jawatan]);

        return $dataProvider;
    }
}
