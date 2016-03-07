<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPelaksaanMajlis;

/**
 * AnugerahPelaksaanMajlisSearch represents the model behind the search form about `app\models\AnugerahPelaksaanMajlis`.
 */
class AnugerahPelaksaanMajlisSearch extends AnugerahPelaksaanMajlis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pelaksaan_majlis_id'], 'integer'],
            [['tarikh_majlis_anugerah', 'nama_ahli_jawatan_kuasa', 'jawatan', 'tarikh_pelantikan', 'tempoh', 'nama_tugas', 'status_tugas'], 'safe'],
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
        $query = AnugerahPelaksaanMajlis::find();

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
            'anugerah_pelaksaan_majlis_id' => $this->anugerah_pelaksaan_majlis_id,
            'tarikh_majlis_anugerah' => $this->tarikh_majlis_anugerah,
            'tarikh_pelantikan' => $this->tarikh_pelantikan,
        ]);

        $query->andFilterWhere(['like', 'nama_ahli_jawatan_kuasa', $this->nama_ahli_jawatan_kuasa])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'tempoh', $this->tempoh])
            ->andFilterWhere(['like', 'nama_tugas', $this->nama_tugas])
            ->andFilterWhere(['like', 'status_tugas', $this->status_tugas]);

        return $dataProvider;
    }
}
