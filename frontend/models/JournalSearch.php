<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Journal;

/**
 * JournalSearch represents the model behind the search form about `app\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['journal_id'], 'integer'],
            [['nama_penulis', 'telefon_no', 'emel', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tarikh_journal', 'bahagian', 'artikel_journal', 'status_journal'], 'safe'],
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
        $query = Journal::find()
                ->joinWith(['refStatusJournal']);

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
            'journal_id' => $this->journal_id,
            'tarikh_journal' => $this->tarikh_journal,
        ]);

        $query->andFilterWhere(['like', 'nama_penulis', $this->nama_penulis])
            ->andFilterWhere(['like', 'telefon_no', $this->telefon_no])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'bahagian', $this->bahagian])
            ->andFilterWhere(['like', 'artikel_journal', $this->artikel_journal])
            ->andFilterWhere(['like', 'tbl_ref_status_journal.desc', $this->status_journal]);

        return $dataProvider;
    }
}
