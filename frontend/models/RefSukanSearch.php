<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefSukan;

use app\models\general\GeneralLabel;

/**
 * RefSukanSearch represents the model behind the search form about `app\models\RefSukan`.
 */
class RefSukanSearch extends RefSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated', 'ref_kategori_sukan_id'], 'safe'],
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
        $query = RefSukan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['refKategoriSukan' => function($query) { $query->from('tbl_ref_kategori_sukan rks');}]);

        $query->andFilterWhere([
            'tbl_ref_sukan.id' => $this->id,
            'tbl_ref_sukan.aktif' => $this->aktif,
            'tbl_ref_sukan.created_by' => $this->created_by,
            'tbl_ref_sukan.updated_by' => $this->updated_by,
            'tbl_ref_sukan.created' => $this->created,
            'tbl_ref_sukan.updated' => $this->updated,

        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->desc])
            ->andFilterWhere(['like', 'rks.desc', $this->ref_kategori_sukan_id]);

        return $dataProvider;
    }
}
