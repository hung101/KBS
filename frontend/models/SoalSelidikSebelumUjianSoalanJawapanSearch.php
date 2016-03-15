<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SoalSelidikSebelumUjianSoalanJawapan;

/**
 * SoalSelidikSebelumUjianSoalanJawapanSearch represents the model behind the search form about `app\models\SoalSelidikSebelumUjianSoalanJawapan`.
 */
class SoalSelidikSebelumUjianSoalanJawapanSearch extends SoalSelidikSebelumUjianSoalanJawapan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soal_selidik_sebelum_ujian_soalan_jawapan_id', 'soal_selidik_sebelum_ujian_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated', 'soalan', 'jawapan', 'session_id'], 'safe'],
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
        $query = SoalSelidikSebelumUjianSoalanJawapan::find()
                ->joinWith(['refSoalanSoalSelidik'])
                ->joinWith(['refJawapanSoalSelidik']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'soal_selidik_sebelum_ujian_soalan_jawapan_id' => $this->soal_selidik_sebelum_ujian_soalan_jawapan_id,
            'soal_selidik_sebelum_ujian_id' => $this->soal_selidik_sebelum_ujian_id,
            'soalan' => $this->soalan,
            'jawapan' => $this->jawapan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);
        
        $query->andFilterWhere(['like', 'tbl_ref_soalan_soal_selidik.desc', $this->soalan])
            ->andFilterWhere(['like', 'tbl_ref_jawapan_soal_selidik.desc', $this->jawapan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
