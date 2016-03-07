<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rehabilitasi;

/**
 * RehabilitasiSearch represents the model behind the search form about `app\models\Rehabilitasi`.
 */
class RehabilitasiSearch extends Rehabilitasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rehabilitasi_id', 'pl_diagnosis_preskripsi_pemeriksaan_id'], 'integer'],
            [['tarikh', 'kesan_klinikal', 'masalah_yang_dikenal_pasti', 'potensi_rehabilitasi', 'matlamat_rehabilitasi'], 'safe'],
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
        $query = Rehabilitasi::find();

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
            'rehabilitasi_id' => $this->rehabilitasi_id,
            'pl_diagnosis_preskripsi_pemeriksaan_id' => $this->pl_diagnosis_preskripsi_pemeriksaan_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'kesan_klinikal', $this->kesan_klinikal])
            ->andFilterWhere(['like', 'masalah_yang_dikenal_pasti', $this->masalah_yang_dikenal_pasti])
            ->andFilterWhere(['like', 'potensi_rehabilitasi', $this->potensi_rehabilitasi])
            ->andFilterWhere(['like', 'matlamat_rehabilitasi', $this->matlamat_rehabilitasi]);

        return $dataProvider;
    }
}
