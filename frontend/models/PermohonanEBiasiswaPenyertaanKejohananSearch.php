<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBiasiswaPenyertaanKejohanan;

/**
 * PermohonanEBiasiswaPenyertaanKejohananSearch represents the model behind the search form about `app\models\PermohonanEBiasiswaPenyertaanKejohanan`.
 */
class PermohonanEBiasiswaPenyertaanKejohananSearch extends PermohonanEBiasiswaPenyertaanKejohanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_kejohanan_id', 'permohonan_e_biasiswa_id'], 'integer'],
            [['sukan', 'tarikh_mula', 'anjuran', 'kejohanan_mewakili', 'acara', 'nama_kejohanan', 'tempat', 'pencapaian', 'session_id'], 'safe'],
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
        $query = PermohonanEBiasiswaPenyertaanKejohanan::find()
                ->joinWith(['refKejohananDiwakili'])
                ->joinWith(['refKejohananPencapaian'])
                ->joinWith(['refAcara'])
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
            'penyertaan_kejohanan_id' => $this->penyertaan_kejohanan_id,
            'permohonan_e_biasiswa_id' => $this->permohonan_e_biasiswa_id,
            'tarikh_mula' => $this->tarikh_mula,
        ]);

        $query->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'anjuran', $this->anjuran])
            ->andFilterWhere(['like', 'kejohanan_mewakili', $this->kejohanan_mewakili])
            ->andFilterWhere(['like', 'acara', $this->acara])
            ->andFilterWhere(['like', 'nama_kejohanan', $this->nama_kejohanan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'pencapaian', $this->pencapaian])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
