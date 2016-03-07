<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPeralatan;

/**
 * PermohonanPeralatanSearch represents the model behind the search form about `app\models\PermohonanPeralatan`.
 */
class PermohonanPeralatanSearch extends PermohonanPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_peralatan_id', 'jumlah_peralatan'], 'integer'],
            [['cawangan', 'negeri', 'sukan', 'program', 'tarikh', 'aktiviti', 'nota_urus_setia', 'kelulusan'], 'safe'],
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
        $query = PermohonanPeralatan::find()
                ->joinWith(['refProgram'])
                ->joinWith(['refCawangan'])
                ->joinWith(['refNegeri'])
                ->joinWith(['refSukan'])
                ->joinWith(['refKelulusan']);

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
            'permohonan_peralatan_id' => $this->permohonan_peralatan_id,
            'tarikh' => $this->tarikh,
            'jumlah_peralatan' => $this->jumlah_peralatan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_cawangan.desc', $this->cawangan])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tbl_ref_program.desc', $this->program])
            ->andFilterWhere(['like', 'aktiviti', $this->aktiviti])
            ->andFilterWhere(['like', 'nota_urus_setia', $this->nota_urus_setia])
            ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan]);

        return $dataProvider;
    }
}
