<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPakaianPeralatan;

/**
 * AtletPakaianPeralatanSearch represents the model behind the search form about `app\models\AtletPakaianPeralatan`.
 */
class AtletPakaianPeralatanSearch extends AtletPakaianPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peralatan_id', 'atlet_id'], 'integer'],
            [['jenis_sukan', 'saiz', 'model', 'jenama', 'warna', 'peralatan', 'tarikh_serahan'], 'safe'],
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
        $query = AtletPakaianPeralatan::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refJenamaPeralatan'])
                ->joinWith(['refPeralatanPinjaman']);

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
            'peralatan_id' => $this->peralatan_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
            ->andFilterWhere(['like', 'saiz', $this->saiz])
                ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'tbl_ref_jenama_peralatan.desc', $this->jenama])
                ->andFilterWhere(['like', 'tbl_ref_peralatan_pinjaman.desc', $this->peralatan])
            ->andFilterWhere(['like', 'warna', $this->warna])
                ->andFilterWhere(['like', 'tarikh_serahan', $this->tarikh_serahan]);

        return $dataProvider;
    }
}
