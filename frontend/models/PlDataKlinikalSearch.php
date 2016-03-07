<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlDataKlinikal;

/**
 * PlDataKlinikalSearch represents the model behind the search form about `app\models\PlDataKlinikal`.
 */
class PlDataKlinikalSearch extends PlDataKlinikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_data_klinikal_id', 'atlet_id', 'usia_kali_pertama_haid', 'bilangan_kanak_kanak', 'perokok_tempoh', 'alkohol', 'berat_badan_turun', 'berat_badan_naik'], 'integer'],
            [['penglihatan_tanpa_cermin_mata_kiri', 'penglihatan_tanpa_cermin_mata_kanan', 'penglihatan_cermin_mata_kiri', 'penglihatan_cermin_mata_kanan', 'haid_kitaran', 'status_haid', 'haid_kali_terakhir_hari_pertama', 'kali_terakhir_bersalin', 'masalah_haid', 'status_perokok', 'jenis_alkohol', 'diet_harian'], 'safe'],
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
        $query = PlDataKlinikal::find();

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
            'pl_data_klinikal_id' => $this->pl_data_klinikal_id,
            'atlet_id' => $this->atlet_id,
            'usia_kali_pertama_haid' => $this->usia_kali_pertama_haid,
            'haid_kali_terakhir_hari_pertama' => $this->haid_kali_terakhir_hari_pertama,
            'kali_terakhir_bersalin' => $this->kali_terakhir_bersalin,
            'bilangan_kanak_kanak' => $this->bilangan_kanak_kanak,
            'perokok_tempoh' => $this->perokok_tempoh,
            'alkohol' => $this->alkohol,
            'berat_badan_turun' => $this->berat_badan_turun,
            'berat_badan_naik' => $this->berat_badan_naik,
        ]);

        $query->andFilterWhere(['like', 'penglihatan_tanpa_cermin_mata_kiri', $this->penglihatan_tanpa_cermin_mata_kiri])
            ->andFilterWhere(['like', 'penglihatan_tanpa_cermin_mata_kanan', $this->penglihatan_tanpa_cermin_mata_kanan])
            ->andFilterWhere(['like', 'penglihatan_cermin_mata_kiri', $this->penglihatan_cermin_mata_kiri])
            ->andFilterWhere(['like', 'penglihatan_cermin_mata_kanan', $this->penglihatan_cermin_mata_kanan])
            ->andFilterWhere(['like', 'haid_kitaran', $this->haid_kitaran])
            ->andFilterWhere(['like', 'status_haid', $this->status_haid])
            ->andFilterWhere(['like', 'masalah_haid', $this->masalah_haid])
            ->andFilterWhere(['like', 'status_perokok', $this->status_perokok])
            ->andFilterWhere(['like', 'jenis_alkohol', $this->jenis_alkohol])
            ->andFilterWhere(['like', 'diet_harian', $this->diet_harian]);

        return $dataProvider;
    }
}
