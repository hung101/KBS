<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihSpkk;

/**
 * JurulatihSpkkSearch represents the model behind the search form about `app\models\JurulatihSpkk`.
 */
class JurulatihSpkkSearch extends JurulatihSpkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_spkk_id', 'jurulatih_id'], 'integer'],
            [['jenis_spkk', 'tahap', 'muatnaik_sijil'], 'safe'],
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
        $query = JurulatihSpkk::find()
                ->joinWith(['refJenisSijilKelayakanJurulatih'])
                ->joinWith(['refTahapKelayakanJurulatih']);

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
            'jurulatih_spkk_id' => $this->jurulatih_spkk_id,
            'jurulatih_id' => $this->jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_sijil_kelayakan_jurulatih.desc', $this->jenis_spkk])
            ->andFilterWhere(['like', 'tbl_ref_tahap_kelayakan_jurulatih.desc', $this->tahap])
            ->andFilterWhere(['like', 'muatnaik_sijil', $this->muatnaik_sijil]);

        return $dataProvider;
    }
}
