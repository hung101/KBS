<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik;

/**
 * LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch represents the model behind the search form about `app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik`.
 */
class LtbsMinitMesyuaratJawatankuasaDokumenMuatNaikSearch extends LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dokumen_muat_naik_id', 'mesyuarat_id'], 'integer'],
            [['nama_dokumen', 'muat_naik', 'session_id'], 'safe'],
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
        $query = LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik::find();

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
            'dokumen_muat_naik_id' => $this->dokumen_muat_naik_id,
            'mesyuarat_id' => $this->mesyuarat_id,
        ]);

        $query->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
