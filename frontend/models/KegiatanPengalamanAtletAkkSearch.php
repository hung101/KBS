<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KegiatanPengalamanAtletAkk;

/**
 * KegiatanPengalamanAtletAkkSearch represents the model behind the search form about `app\models\KegiatanPengalamanAtletAkk`.
 */
class KegiatanPengalamanAtletAkkSearch extends KegiatanPengalamanAtletAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kegiatan_pengalaman_atlet_akk_id', 'akademi_akk_id'], 'integer'],
            [['nama_sukan_pertandingan', 'tahun', 'sukan_acara', 'pencapaian', 'session_id'], 'safe'],
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
        $query = KegiatanPengalamanAtletAkk::find()
                ->joinWith(['refAcara']);

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
            'kegiatan_pengalaman_atlet_akk_id' => $this->kegiatan_pengalaman_atlet_akk_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'nama_sukan_pertandingan', $this->nama_sukan_pertandingan])
            ->andFilterWhere(['like', 'ref_tbl_acara.desc', $this->sukan_acara])
            ->andFilterWhere(['like', 'pencapaian', $this->pencapaian])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
