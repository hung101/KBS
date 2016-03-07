<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKehadiranMediaProgram;

/**
 * PengurusanKehadiranMediaProgramSearch represents the model behind the search form about `app\models\PengurusanKehadiranMediaProgram`.
 */
class PengurusanKehadiranMediaProgramSearch extends PengurusanKehadiranMediaProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kehadiran_media_program_id', 'pengurusan_media_program_id'], 'integer'],
            [['program', 'nama_wartawan', 'emel', 'agensi', 'no_telefon', 'session_id'], 'safe'],
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
        $query = PengurusanKehadiranMediaProgram::find()
                ->joinWith(['refProfilWartawanSukan']);

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
            'pengurusan_kehadiran_media_program_id' => $this->pengurusan_kehadiran_media_program_id,
            'pengurusan_media_program_id' => $this->pengurusan_media_program_id,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'tbl_profil_wartawan_sukan.nama', $this->nama_wartawan])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'agensi', $this->agensi])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
