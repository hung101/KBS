<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPenyelidikan;

/**
 * PermohonanPenyelidikanSearch represents the model behind the search form about `app\models\PermohonanPenyelidikan`.
 */
class PermohonanPenyelidikanSearch extends PermohonanPenyelidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonana_penyelidikan_id', 'biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan'], 'integer'],
            [['nama_permohon', 'tarikh_permohonan', 'tajuk_penyelidikan', 'ringkasan_permohonan'], 'safe'],
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
        $query = PermohonanPenyelidikan::find();

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
            'permohonana_penyelidikan_id' => $this->permohonana_penyelidikan_id,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'biasa_dengan_keperluan_penyelidikan' => $this->biasa_dengan_keperluan_penyelidikan,
            'kelulusan_echics' => $this->kelulusan_echics,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'nama_permohon', $this->nama_permohon])
            ->andFilterWhere(['like', 'tajuk_penyelidikan', $this->tajuk_penyelidikan])
            ->andFilterWhere(['like', 'ringkasan_permohonan', $this->ringkasan_permohonan]);

        return $dataProvider;
    }
}
