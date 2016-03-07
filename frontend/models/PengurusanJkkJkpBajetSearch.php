<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJkkJkpBajet;

/**
 * PengurusanJkkJkpBajetSearch represents the model behind the search form about `app\models\PengurusanJkkJkpBajet`.
 */
class PengurusanJkkJkpBajetSearch extends PengurusanJkkJkpBajet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jkk_jkp_bajet_id', 'pengurusan_jkk_jkp_id'], 'integer'],
            [['kategori_bajet'], 'safe'],
            [['jumlah_bajet'], 'number'],
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
        $query = PengurusanJkkJkpBajet::find()
                ->joinWith(['refKategoriBajetJkkJkp']);

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
            'pengurusan_jkk_jkp_bajet_id' => $this->pengurusan_jkk_jkp_bajet_id,
            'pengurusan_jkk_jkp_id' => $this->pengurusan_jkk_jkp_id,
            'jumlah_bajet' => $this->jumlah_bajet,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_bajet_jkk_jkp.desc', $this->kategori_bajet]);

        return $dataProvider;
    }
}
