<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanElaunMuatnaik;

/**
 * BantuanElaunMuatnaikSearch represents the model behind the search form about `app\models\BantuanElaunMuatnaik`.
 */
class BantuanElaunMuatnaikSearch extends BantuanElaunMuatnaik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_elaun_muatnaik_id', 'bantuan_elaun_id'], 'integer'],
            [['butiran_permohonan', 'muatnaik_dokumen', 'session_id'], 'safe'],
            [['amaun'], 'number'],
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
        $query = BantuanElaunMuatnaik::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bantuan_elaun_muatnaik_id' => $this->bantuan_elaun_muatnaik_id,
            'bantuan_elaun_id' => $this->bantuan_elaun_id,
            'amaun' => $this->amaun,
        ]);

        $query->andFilterWhere(['like', 'butiran_permohonan', $this->butiran_permohonan])
            ->andFilterWhere(['like', 'muatnaik_dokumen', $this->muatnaik_dokumen])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
