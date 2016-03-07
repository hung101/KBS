<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenginapan;

/**
 * PengurusanPenginapanSearch represents the model behind the search form about `app\models\PengurusanPenginapan`.
 */
class PengurusanPenginapanSearch extends PengurusanPenginapan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penginapan_id'], 'integer'],
            [['nama_pegawai', 'atlet_id', 'tarikh_masa_penginapan_mula', 'tarikh_masa_penginapan_akhir', 'lokasi', 'nama_penginapan'], 'safe'],
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
        $query = PengurusanPenginapan::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refPegawaiPengurusanPenginapan']);

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
            'pengurusan_penginapan_id' => $this->pengurusan_penginapan_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_masa_penginapan_mula' => $this->tarikh_masa_penginapan_mula,
            'tarikh_masa_penginapan_akhir' => $this->tarikh_masa_penginapan_akhir,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_pegawai_pengurusan_penginapan.desc', $this->nama_pegawai])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'nama_penginapan', $this->nama_penginapan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
