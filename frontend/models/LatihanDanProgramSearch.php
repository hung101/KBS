<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanDanProgram;

/**
 * LatihanDanProgramSearch represents the model behind the search form about `app\models\LatihanDanProgram`.
 */
class LatihanDanProgramSearch extends LatihanDanProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latihan_dan_program_id', 'bilangan_ahli_yang_menyertai'], 'integer'],
            [['kategori_kursus', 'nama_kursus', 'tarikh_kursus', 'lokasi_kursus', 'penganjuran_kursus'], 'safe'],
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
        $query = LatihanDanProgram::find()
                ->joinWith(['refKategoriKursus']);

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
            'latihan_dan_program_id' => $this->latihan_dan_program_id,
            'tarikh_kursus' => $this->tarikh_kursus,
            'bilangan_ahli_yang_menyertai' => $this->bilangan_ahli_yang_menyertai,
        ]);

        $query->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
                ->andFilterWhere(['like', 'tbl_ref_kategori_kursus.desc', $this->kategori_kursus])
            ->andFilterWhere(['like', 'lokasi_kursus', $this->lokasi_kursus])
            ->andFilterWhere(['like', 'penganjuran_kursus', $this->penganjuran_kursus]);

        return $dataProvider;
    }
}
