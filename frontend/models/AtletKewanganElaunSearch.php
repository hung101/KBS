<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKewanganElaun;

/**
 * AtletKewanganElaunSearch represents the model behind the search form about `app\models\AtletKewanganElaun`.
 */
class AtletKewanganElaunSearch extends AtletKewanganElaun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaun_id', 'atlet_id'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['tarikh_mula','jenis_elaun'], 'safe'],
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
        $query = AtletKewanganElaun::find()
                ->joinWith(['refJenisElaun']);

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
            'elaun_id' => $this->elaun_id,
            'atlet_id' => $this->atlet_id,
            //'jenis_elaun' => $this->jenis_elaun,
            'jumlah_elaun' => $this->jumlah_elaun,
            'tarikh_mula' => $this->tarikh_mula,
        ]);
        
        $query->andFilterWhere(['like', 'tbl_ref_jenis_elaun.desc', $this->jenis_elaun]);

        return $dataProvider;
    }
}
