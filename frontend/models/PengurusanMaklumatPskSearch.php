<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanMaklumatPsk;

/**
 * PengurusanMaklumatPskSearch represents the model behind the search form about `app\models\PengurusanMaklumatPsk`.
 */
class PengurusanMaklumatPskSearch extends PengurusanMaklumatPsk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_maklumat_psk_id', 'jumlah_sponsor'], 'integer'],
            [['nama_sponsor', 'tarikh_sponsor_mula', 'tarikh_sponsor_tamat'], 'safe'],
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
        $query = PengurusanMaklumatPsk::find();

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
            'pengurusan_maklumat_psk_id' => $this->pengurusan_maklumat_psk_id,
            'jumlah_sponsor' => $this->jumlah_sponsor,
            'tarikh_sponsor_mula' => $this->tarikh_sponsor_mula,
            'tarikh_sponsor_tamat' => $this->tarikh_sponsor_tamat,
        ]);

        $query->andFilterWhere(['like', 'nama_sponsor', $this->nama_sponsor]);

        return $dataProvider;
    }
}
