<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CadanganElaun;

/**
 * CadanganElaunSearch represents the model behind the search form about `app\models\CadanganElaun`.
 */
class CadanganElaunSearch extends CadanganElaun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cadangan_elaun_id', 'atlet'], 'integer'],
            [['elaun_semasa', 'elaun_cadangan'], 'number'],
            [['tarikh_mula', 'tarikh_tamat', 'ulasan', 'jenis_kelulusan', 'muat_naik'], 'safe'],
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
        $query = CadanganElaun::find();

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
            'cadangan_elaun_id' => $this->cadangan_elaun_id,
            'atlet' => $this->atlet,
            'elaun_semasa' => $this->elaun_semasa,
            'elaun_cadangan' => $this->elaun_cadangan,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
        ]);

        $query->andFilterWhere(['like', 'ulasan', $this->ulasan])
            ->andFilterWhere(['like', 'jenis_kelulusan', $this->jenis_kelulusan])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik]);

        return $dataProvider;
    }
}
