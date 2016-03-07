<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GajiDanElaunJurulatih;

/**
 * GajiDanElaunJurulatihSearch represents the model behind the search form about `app\models\GajiDanElaunJurulatih`.
 */
class GajiDanElaunJurulatihSearch extends GajiDanElaunJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaji_dan_elaun_jurulatih_id'], 'integer'],
            [['no_kad_pengenalan', 'nama_jurulatih', 'no_passport', 'nama_sukan', 'tarikh_mula', 'bank', 'no_akaun', 'cawangan', 'catatan'], 'safe'],
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
        $query = GajiDanElaunJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refBank']);

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
            'gaji_dan_elaun_jurulatih_id' => $this->gaji_dan_elaun_jurulatih_id,
            //'nama_jurulatih' => $this->nama_jurulatih,
        ]);

        $query->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'no_passport', $this->no_passport])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
            ->andFilterWhere(['like', 'tbl_ref_bank.desc', $this->bank])
            ->andFilterWhere(['like', 'no_akaun', $this->no_akaun])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
