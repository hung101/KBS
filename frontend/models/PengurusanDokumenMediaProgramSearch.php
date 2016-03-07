<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanDokumenMediaProgram;

/**
 * PengurusanDokumenMediaProgramSearch represents the model behind the search form about `app\models\PengurusanDokumenMediaProgram`.
 */
class PengurusanDokumenMediaProgramSearch extends PengurusanDokumenMediaProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_dokumen_media_program_id', 'pengurusan_media_program_id'], 'integer'],
            [['kategori_dokumen', 'nama_dokumen', 'muatnaik', 'session_id'], 'safe'],
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
        $query = PengurusanDokumenMediaProgram::find()
                ->joinWith(['refKategoriDokumen']);

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
            'pengurusan_dokumen_media_program_id' => $this->pengurusan_dokumen_media_program_id,
            'pengurusan_media_program_id' => $this->pengurusan_media_program_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_dokumen.desc', $this->kategori_dokumen])
            ->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'muatnaik', $this->muatnaik])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
