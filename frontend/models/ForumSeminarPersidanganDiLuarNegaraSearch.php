<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ForumSeminarPersidanganDiLuarNegara;

/**
 * ForumSeminarPersidanganDiLuarNegaraSearch represents the model behind the search form about `app\models\ForumSeminarPersidanganDiLuarNegara`.
 */
class ForumSeminarPersidanganDiLuarNegaraSearch extends ForumSeminarPersidanganDiLuarNegara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_seminar_persidangan_di_luar_negara_id'], 'integer'],
			[['jumlah_diluluskan'], 'number'],
            [['nama', 'negara', 'status_permohonan', 'catatan'], 'safe'],
            [['amaun'], 'number'],
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
        $query = ForumSeminarPersidanganDiLuarNegara::find()
                ->joinWith(['refNegara'])
                ->joinWith(['refStatusPermohonanBantuanMenghadiriProgramAntarabangs']);

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
            'forum_seminar_persidangan_di_luar_negara_id' => $this->forum_seminar_persidangan_di_luar_negara_id,
            'amaun' => $this->amaun,
			'jumlah_diluluskan' => $this->jumlah_diluluskan,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_negara.desc', $this->negara])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_bantuan_menghadiri_program_antarabangs.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
