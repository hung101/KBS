<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DokumenPenyelidikan;

/**
 * DokumenPenyelidikanSearch represents the model behind the search form about `app\models\DokumenPenyelidikan`.
 */
class DokumenPenyelidikanSearch extends DokumenPenyelidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dokumen_penyelidikan_id', 'permohonana_penyelidikan_id'], 'integer'],
            [['nama_dokumen', 'muat_naik', 'session_id'], 'safe'],
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
        $query = DokumenPenyelidikan::find()
                ->joinWith(['refDokumenPenyelidikan']);

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
            'dokumen_penyelidikan_id' => $this->dokumen_penyelidikan_id,
            'permohonana_penyelidikan_id' => $this->permohonana_penyelidikan_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_dokumen_penyelidikan.desc', $this->nama_dokumen])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
