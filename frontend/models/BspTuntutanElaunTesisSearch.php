<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspTuntutanElaunTesis;

/**
 * BspTuntutanElaunTesisSearch represents the model behind the search form about `app\models\BspTuntutanElaunTesis`.
 */
class BspTuntutanElaunTesisSearch extends BspTuntutanElaunTesis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_tuntutan_elaun_tesis_od', 'bsp_pemohon_id'], 'integer'],
            [['tarikh', 'tajuk_tesis'], 'safe'],
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
        $query = BspTuntutanElaunTesis::find();

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
            'bsp_tuntutan_elaun_tesis_od' => $this->bsp_tuntutan_elaun_tesis_od,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tajuk_tesis', $this->tajuk_tesis]);

        return $dataProvider;
    }
}
