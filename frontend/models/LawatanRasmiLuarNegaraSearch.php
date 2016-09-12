<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LawatanRasmiLuarNegara;

/**
 * LawatanRasmiLuarNegaraSearch represents the model behind the search form about `app\models\LawatanRasmiLuarNegara`.
 */
class LawatanRasmiLuarNegaraSearch extends LawatanRasmiLuarNegara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lawatan_rasmi_luar_negara_id', 'jumlah_delegasi', 'created_by', 'updated_by'], 'integer'],
            [['lawatan', 'negara', 'tarikh', 'delegasi', 'nama_pegawai_terlibat', 'catatan', 'created', 'updated'], 'safe'],
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
        $query = LawatanRasmiLuarNegara::find()
                ->joinWith(['refNegara'])
                ->joinWith(['refLawatan']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'lawatan_rasmi_luar_negara_id' => $this->lawatan_rasmi_luar_negara_id,
            'tarikh' => $this->tarikh,
            'jumlah_delegasi' => $this->jumlah_delegasi,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_lawatan.desc', $this->lawatan])
            ->andFilterWhere(['like', 'tbl_ref_negara.desc', $this->negara])
            ->andFilterWhere(['like', 'delegasi', $this->delegasi])
            ->andFilterWhere(['like', 'nama_pegawai_terlibat', $this->nama_pegawai_terlibat])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
