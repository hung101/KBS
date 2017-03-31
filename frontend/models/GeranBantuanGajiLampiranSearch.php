<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeranBantuanGajiLampiran;

class GeranBantuanGajiLampiranSearch extends GeranBantuanGajiLampiran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geran_bantuan_gaji_lampiran_id', 'geran_bantuan_gaji_id', 'created_by', 'updated_by'], 'integer'],
            [['lampiran', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = GeranBantuanGajiLampiran::find()->joinWith(['refDokumenGeranBantuanGaji']);

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
            'geran_bantuan_gaji_lampiran_id' => $this->geran_bantuan_gaji_lampiran_id,
            'geran_bantuan_gaji_id' => $this->geran_bantuan_gaji_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'lampiran', $this->lampiran])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
