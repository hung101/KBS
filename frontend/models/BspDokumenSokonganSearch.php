<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspDokumenSokongan;

/**
 * BspDokumenSokonganSearch represents the model behind the search form about `app\models\BspDokumenSokongan`.
 */
class BspDokumenSokonganSearch extends BspDokumenSokongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_dokumen_sokongan_id', 'bsp_pemohon_id'], 'integer'],
            [['nama_dokumen', 'upload'], 'safe'],
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
        $query = BspDokumenSokongan::find();

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
            'bsp_dokumen_sokongan_id' => $this->bsp_dokumen_sokongan_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
        ]);

        $query->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'upload', $this->upload]);

        return $dataProvider;
    }
}
