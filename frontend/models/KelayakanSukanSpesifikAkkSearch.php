<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KelayakanSukanSpesifikAkk;

/**
 * KelayakanSukanSpesifikAkkSearch represents the model behind the search form about `app\models\KelayakanSukanSpesifikAkk`.
 */
class KelayakanSukanSpesifikAkkSearch extends KelayakanSukanSpesifikAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelayakan_sukan_spesifik_akk_id', 'akademi_akk_id'], 'integer'],
            [['nama_kursus', 'tahap', 'tahun_lulus', 'persatuan_sukan', 'session_id'], 'safe'],
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
        $query = KelayakanSukanSpesifikAkk::find();

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
            'kelayakan_sukan_spesifik_akk_id' => $this->kelayakan_sukan_spesifik_akk_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun_lulus' => $this->tahun_lulus,
        ]);

        $query->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'tahap', $this->tahap])
            ->andFilterWhere(['like', 'persatuan_sukan', $this->persatuan_sukan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
