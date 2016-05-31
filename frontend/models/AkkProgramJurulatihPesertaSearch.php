<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AkkProgramJurulatihPeserta;

/**
 * AkkProgramJurulatihPesertaSearch represents the model behind the search form about `app\models\AkkProgramJurulatihPeserta`.
 */
class AkkProgramJurulatihPesertaSearch extends AkkProgramJurulatihPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akk_program_jurulatih_peserta_id', 'akk_program_jurulatih_id', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'jurulatih', 'sukan', 'acara', 'created', 'updated'], 'safe'],
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
        $query = AkkProgramJurulatihPeserta::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara']);

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
            'akk_program_jurulatih_peserta_id' => $this->akk_program_jurulatih_peserta_id,
            'akk_program_jurulatih_id' => $this->akk_program_jurulatih_id,
            //'jurulatih' => $this->jurulatih,
            //'sukan' => $this->sukan,
            //'acara' => $this->acara,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
                ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->acara]);

        return $dataProvider;
    }
}
