<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihKesihatanMasalah;

/**
 * JurulatihKesihatanMasalahSearch represents the model behind the search form about `app\models\JurulatihKesihatanMasalah`.
 */
class JurulatihKesihatanMasalahSearch extends JurulatihKesihatanMasalah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_kesihatan_kesihatan_id', 'jurulatih_kesihatan_id', 'created_by', 'updated_by'], 'integer'],
            [['masalah_kesihatan', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = JurulatihKesihatanMasalah::find()
                ->joinWith(['refMasalahKesihatan']);

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
            'jurulatih_kesihatan_kesihatan_id' => $this->jurulatih_kesihatan_kesihatan_id,
            'jurulatih_kesihatan_id' => $this->jurulatih_kesihatan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_masalah_kesihatan.desc', $this->masalah_kesihatan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
