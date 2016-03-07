<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerlembagaanBadanSukan;

/**
 * PerlembagaanBadanSukanSearch represents the model behind the search form about `app\models\PerlembagaanBadanSukan`.
 */
class PerlembagaanBadanSukanSearch extends PerlembagaanBadanSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perlembagaan_badan_sukan_id', 'profil_badan_sukan_id'], 'integer'],
            [['tarikh_kelulusan_Terkini', 'bilangan_pindaan_perlembagaan_dilakukan', 'tarikh_pindaan', 'tarikh_kelulusan', 'muat_naik'], 'safe'],
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
        $query = PerlembagaanBadanSukan::find();

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
            'perlembagaan_badan_sukan_id' => $this->perlembagaan_badan_sukan_id,
            'profil_badan_sukan_id' => $this->profil_badan_sukan_id,
            'tarikh_kelulusan_Terkini' => $this->tarikh_kelulusan_Terkini,
            'tarikh_pindaan' => $this->tarikh_pindaan,
            'tarikh_kelulusan' => $this->tarikh_kelulusan,
        ]);

        $query->andFilterWhere(['like', 'bilangan_pindaan_perlembagaan_dilakukan', $this->bilangan_pindaan_perlembagaan_dilakukan])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik]);

        return $dataProvider;
    }
}
