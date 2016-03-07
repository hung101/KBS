<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsSumberKewangan;

/**
 * LtbsSumberKewanganSearch represents the model behind the search form about `app\models\LtbsSumberKewangan`.
 */
class LtbsSumberKewanganSearch extends LtbsSumberKewangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sumber_kewangan_id'], 'integer'],
            [['jenis', 'sumber'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = LtbsSumberKewangan::find()
                ->joinWith(['refJenisKewangan'])
                ->joinWith(['refJenisKewanganSumber']);

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
            'sumber_kewangan_id' => $this->sumber_kewangan_id,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_kewangan.desc', $this->jenis])
            ->andFilterWhere(['like', 'tbl_ref_jenis_kewangan_sumber.desc', $this->sumber]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
