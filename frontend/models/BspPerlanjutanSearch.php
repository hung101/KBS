<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPerlanjutan;

/**
 * BspPerlanjutanSearch represents the model behind the search form about `app\models\BspPerlanjutan`.
 */
class BspPerlanjutanSearch extends BspPerlanjutan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_perlanjutan_id', 'bsp_pemohon_id'], 'integer'],
            [['tarikh', 'tempoh_mohon_perlanjutan', 'permohonan_pelanjutan'], 'safe'],
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
        $query = BspPerlanjutan::find()
                    ->joinWith(['refPermohonanPelanjutan']);

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
            'bsp_perlanjutan_id' => $this->bsp_perlanjutan_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tempoh_mohon_perlanjutan', $this->tempoh_mohon_perlanjutan])
            ->andFilterWhere(['like', 'tbl_ref_permohonan_pelanjutan.desc', $this->permohonan_pelanjutan]);

        return $dataProvider;
    }
}
