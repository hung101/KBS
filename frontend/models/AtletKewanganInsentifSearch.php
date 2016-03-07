<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKewanganInsentif;

/**
 * AtletKewanganInsentifSearch represents the model behind the search form about `app\models\AtletKewanganInsentif`.
 */
class AtletKewanganInsentifSearch extends AtletKewanganInsentif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insentif_id', 'atlet_id'], 'integer'],
            [['tarikh_mula', 'jenis_insentif', 'pencapaian'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = AtletKewanganInsentif::find()
                ->joinWith(['refJenisInsentif']);

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
            'insentif_id' => $this->insentif_id,
            'atlet_id' => $this->atlet_id,
            'tarikh_mula' => $this->tarikh_mula,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_insentif.desc', $this->jenis_insentif])
            ->andFilterWhere(['like', 'pencapaian', $this->pencapaian]);

        return $dataProvider;
    }
}
