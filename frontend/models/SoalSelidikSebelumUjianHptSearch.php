<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SoalSelidikSebelumUjianHpt;

/**
 * SoalSelidikSebelumUjianHptSearch represents the model behind the search form about `app\models\SoalSelidikSebelumUjianHpt`.
 */
class SoalSelidikSebelumUjianHptSearch extends SoalSelidikSebelumUjianHpt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soal_selidik_sebelum_ujian_id'], 'integer'],
            [['tarikh', 'soalan', 'jawapan', 'atlet_id', 'pemilihan_ujian', 'pegawai_bertanggungjawab'], 'safe'],
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
        $query = SoalSelidikSebelumUjianHpt::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refSoalanSoalSelidik'])
                ->joinWith(['refJawapanSoalSelidik']);

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
            'soal_selidik_sebelum_ujian_id' => $this->soal_selidik_sebelum_ujian_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_soalan_soal_selidik.desc', $this->soalan])
            ->andFilterWhere(['like', 'tbl_ref_jawapan_soal_selidik.desc', $this->jawapan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                ->andFilterWhere(['like', 'pemilihan_ujian', $this->pemilihan_ujian])
                ->andFilterWhere(['like', 'pegawai_bertanggungjawab', $this->pegawai_bertanggungjawab]);

        return $dataProvider;
    }
}
