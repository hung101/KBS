<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PsikologiAktiviti;

/**
 * PsikologiAktivitiSearch represents the model behind the search form about `app\models\PsikologiAktiviti`.
 */
class PsikologiAktivitiSearch extends PsikologiAktiviti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['psikologi_aktiviti_id', 'psikologi_profil_id'], 'integer'],
            [['nama_aktiviti', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
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
        $query = PsikologiAktiviti::find();

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
            'psikologi_aktiviti_id' => $this->psikologi_aktiviti_id,
            'psikologi_profil_id' => $this->psikologi_profil_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
        ]);

        $query->andFilterWhere(['like', 'nama_aktiviti', $this->nama_aktiviti]);

        return $dataProvider;
    }
}
