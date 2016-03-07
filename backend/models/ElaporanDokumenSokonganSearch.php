<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanDokumenSokongan;

/**
 * ElaporanDokumenSokonganSearch represents the model behind the search form about `app\models\ElaporanDokumenSokongan`.
 */
class ElaporanDokumenSokonganSearch extends ElaporanDokumenSokongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_dokumen_sokongan_id', 'elaporan_pelaksaan_id'], 'integer'],
            [['nama', 'muat_nail'], 'safe'],
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
        $query = ElaporanDokumenSokongan::find();

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
            'elaporan_dokumen_sokongan_id' => $this->elaporan_dokumen_sokongan_id,
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'muat_nail', $this->muat_nail]);

        return $dataProvider;
    }
}
