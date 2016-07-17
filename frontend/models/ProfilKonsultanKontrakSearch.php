<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilKonsultanKontrak;

/**
 * ProfilKonsultanKontrakSearch represents the model behind the search form about `app\models\ProfilKonsultanKontrak`.
 */
class ProfilKonsultanKontrakSearch extends ProfilKonsultanKontrak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_konsultan_kontrak_id', 'profil_konsultan_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_kontrak_mula', 'tarikh_kontrak_akhir', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = ProfilKonsultanKontrak::find();

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
            'profil_konsultan_kontrak_id' => $this->profil_konsultan_kontrak_id,
            'profil_konsultan_id' => $this->profil_konsultan_id,
            'tarikh_kontrak_mula' => $this->tarikh_kontrak_mula,
            'tarikh_kontrak_akhir' => $this->tarikh_kontrak_akhir,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
