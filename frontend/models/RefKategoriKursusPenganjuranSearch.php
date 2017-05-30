<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefKategoriKursusPenganjuran;

/**
 * RefKategoriKursusPenganjuranSearch represents the model behind the search form about `app\models\RefKategoriKursusPenganjuran`.
 */
class RefKategoriKursusPenganjuranSearch extends RefKategoriKursusPenganjuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated', 'ref_kategori_kursus_penganjuran_akk_id'], 'safe'],
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
        $query = RefKategoriKursusPenganjuran::find()
                ->joinWith('refKategoriKursusPenganjuranAkk');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'aktif' => $this->aktif,
            'tbl_ref_kategori_kursus_penganjuran_akk.desc' => $this->ref_kategori_kursus_penganjuran_akk_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
