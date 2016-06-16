<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPelantikanSue;

/**
 * PermohonanPelantikanSueSearch represents the model behind the search form about `app\models\PermohonanPelantikanSue`.
 */
class PermohonanPelantikanSueSearch extends PermohonanPelantikanSue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_pelantikan_sue_id', 'nama_persatuan', 'status_permohonan', 'created_by', 'updated_by'], 'integer'],
            [['nama_sue', 'no_kad_pengenalan', 'emel', 'jumlah_dipohon', 'tarikh_mula_khidmat', 'sehingga', 'muatnaik', 'catatan', 'tarikh_dipohon', 'tarikh_kelulusan_jkb', 'bilangan_jkb', 'tarikh_lantikan', 'tarikh_tamat_lantikan', 'tempoh', 'created', 'updated'], 'safe'],
            [['jumlah_diluluskan'], 'number'],
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
        $query = PermohonanPelantikanSue::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'permohonan_pelantikan_sue_id' => $this->permohonan_pelantikan_sue_id,
            'nama_persatuan' => $this->nama_persatuan,
            'tarikh_mula_khidmat' => $this->tarikh_mula_khidmat,
            'sehingga' => $this->sehingga,
            'status_permohonan' => $this->status_permohonan,
            'tarikh_dipohon' => $this->tarikh_dipohon,
            'jumlah_diluluskan' => $this->jumlah_diluluskan,
            'tarikh_kelulusan_jkb' => $this->tarikh_kelulusan_jkb,
            'tarikh_lantikan' => $this->tarikh_lantikan,
            'tarikh_tamat_lantikan' => $this->tarikh_tamat_lantikan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_sue', $this->nama_sue])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'jumlah_dipohon', $this->jumlah_dipohon])
            ->andFilterWhere(['like', 'muatnaik', $this->muatnaik])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'bilangan_jkb', $this->bilangan_jkb])
            ->andFilterWhere(['like', 'tempoh', $this->tempoh]);

        return $dataProvider;
    }
}
