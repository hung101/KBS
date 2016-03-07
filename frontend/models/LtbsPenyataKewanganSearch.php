<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsPenyataKewangan;

/**
 * LtbsPenyataKewanganSearch represents the model behind the search form about `app\models\LtbsPenyataKewangan`.
 */
class LtbsPenyataKewanganSearch extends LtbsPenyataKewangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyata_kewangan_id'], 'integer'],
            [['penyata_penerimaan_dan_pembayaran', 'penyata_pendapatan_dan_perbelanjaan', 'kunci_kira_kira'], 'safe'],
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
        $query = LtbsPenyataKewangan::find();

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
            'penyata_kewangan_id' => $this->penyata_kewangan_id,
        ]);

        $query->andFilterWhere(['like', 'penyata_penerimaan_dan_pembayaran', $this->penyata_penerimaan_dan_pembayaran])
            ->andFilterWhere(['like', 'penyata_pendapatan_dan_perbelanjaan', $this->penyata_pendapatan_dan_perbelanjaan])
            ->andFilterWhere(['like', 'kunci_kira_kira', $this->kunci_kira_kira]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
