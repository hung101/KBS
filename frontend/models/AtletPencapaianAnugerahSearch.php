<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPencapaianAnugerah;

/**
 * AtletPencapaianAnugerahSearch represents the model behind the search form about `app\models\AtletPencapaianAnugerah`.
 */
class AtletPencapaianAnugerahSearch extends AtletPencapaianAnugerah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_id', 'atlet_id', 'insentif_id'], 'integer'],
            [['tahun', 'nama_acara', 'kategori'], 'safe'],
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
        $query = AtletPencapaianAnugerah::find()
                ->joinWith(['refKategoriAnugerah'])
                ->joinWith(['refAcara']);

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
            'anugerah_id' => $this->anugerah_id,
            'atlet_id' => $this->atlet_id,
            'tahun' => $this->tahun,
            'insentif_id' => $this->insentif_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'tbl_ref_kategori_anugerah.desc', $this->kategori]);

        return $dataProvider;
    }
}
