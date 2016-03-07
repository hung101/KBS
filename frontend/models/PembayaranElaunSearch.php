<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranElaun;

/**
 * PembayaranElaunSearch represents the model behind the search form about `app\models\PembayaranElaun`.
 */
class PembayaranElaunSearch extends PembayaranElaun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembayaran_elaun_id', 'kelulusan'], 'integer'],
            [['jenis_atlet', 'atlet_id', 'kategori_elaun', 'tempoh_elaun', 'sebab_elaun'], 'safe'],
            [['jumlah_elaun'], 'number'],
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
        $query = PembayaranElaun::find()
                ->joinWith(['kategoriElaun'])
                ->joinWith(['statusElaun'])
                ->joinWith(['atlet']);

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
            'pembayaran_elaun_id' => $this->pembayaran_elaun_id,
            //'atlet_id' => $this->atlet_id,
            'jumlah_elaun' => $this->jumlah_elaun,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'jenis_atlet', $this->jenis_atlet])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            //->andFilterWhere(['like', 'kategori_elaun', $this->kategori_elaun])
                ->andFilterWhere(['like', 'tbl_ref_kategori_elaun.desc', $this->kategori_elaun])
                 ->andFilterWhere(['like', 'tbl_ref_status_elaun.desc', $this->status_elaun])
            ->andFilterWhere(['like', 'tempoh_elaun', $this->tempoh_elaun])
            ->andFilterWhere(['like', 'sebab_elaun', $this->sebab_elaun]);

        return $dataProvider;
    }
}
