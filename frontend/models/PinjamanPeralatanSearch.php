<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PinjamanPeralatan;

/**
 * PinjamanPeralatanSearch represents the model behind the search form about `app\models\PinjamanPeralatan`.
 */
class PinjamanPeralatanSearch extends PinjamanPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pinjaman_peralatan_id', 'kuantiti'], 'integer'],
            [['nama_peralatan', 'atlet_id', 'tarikh_diberi', 'tarikh_dipulang', 'tempoh_pinjaman'], 'safe'],
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
        $query = PinjamanPeralatan::find()
                ->joinWith(['refPeralatanPinjaman'])
                ->joinWith(['refAtlet']);

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
            'pinjaman_peralatan_id' => $this->pinjaman_peralatan_id,
            //'atlet_id' => $this->atlet_id,
            'kuantiti' => $this->kuantiti,
            'tarikh_diberi' => $this->tarikh_diberi,
            'tarikh_dipulang' => $this->tarikh_dipulang,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_peralatan_pinjaman.desc', $this->nama_peralatan])
            ->andFilterWhere(['like', 'tempoh_pinjaman', $this->tempoh_pinjaman])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
