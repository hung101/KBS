<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPerkhidmatanPermakanan;

/**
 * PermohonanPerkhidmatanPermakananSearch represents the model behind the search form about `app\models\PermohonanPerkhidmatanPermakanan`.
 */
class PermohonanPerkhidmatanPermakananSearch extends PermohonanPerkhidmatanPermakanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_perkhidmatan_permakanan_id', 'kelulusan'], 'integer'],
            [['tarikh', 'atlet_id', 'sukan', 'tujuan', 'kategori_permohonan', 'jenis_perkhidmatan'], 'safe'],
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
        $query = PermohonanPerkhidmatanPermakanan::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refSukan']);

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
            'permohonan_perkhidmatan_permakanan_id' => $this->permohonan_perkhidmatan_permakanan_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'kategori_permohonan', $this->kategori_permohonan])
            ->andFilterWhere(['like', 'jenis_perkhidmatan', $this->jenis_perkhidmatan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
