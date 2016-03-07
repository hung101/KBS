<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenganjuranKursusPenganjur;

/**
 * PenganjuranKursusPenganjurSearch represents the model behind the search form about `app\models\PenganjuranKursusPenganjur`.
 */
class PenganjuranKursusPenganjurSearch extends PenganjuranKursusPenganjur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_kursus_penganjur_id'], 'integer'],
            [['kategori_kursus', 'nama_kursus', 'kod_kursus', 'tarikh', 'tempat'], 'safe'],
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
        $query = PenganjuranKursusPenganjur::find()
                ->joinWith(['refKategoriKursusPenganjuran']);

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
            'penganjuran_kursus_penganjur_id' => $this->penganjuran_kursus_penganjur_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_kursus_penganjuran.desc', $this->kategori_kursus])
            ->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }
}
