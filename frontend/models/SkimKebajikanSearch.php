<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SkimKebajikan;

/**
 * SkimKebajikanSearch represents the model behind the search form about `app\models\SkimKebajikan`.
 */
class SkimKebajikanSearch extends SkimKebajikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skim_kebajikan_id', 'kelulusan'], 'integer'],
            [['jenis_bantuan_skak', 'nama_pemohon', 'nama_penerima', 'jenis_sukan', 'masalah_dihadapi', 'tarikh_kejadian', 'lokasi_kejadian', 'jenis_bantuan_lain_yang_diterima'], 'safe'],
            [['jumlah_bantuan'], 'number'],
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
        $query = SkimKebajikan::find()
                ->joinWith(['atlet'])
                ->joinWith(['refSukan'])
                ->joinWith(['refJenisBantuanSKAK']);

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
            'skim_kebajikan_id' => $this->skim_kebajikan_id,
            'jumlah_bantuan' => $this->jumlah_bantuan,
            'tarikh_kejadian' => $this->tarikh_kejadian,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_bantuan_skak.desc', $this->jenis_bantuan_skak])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->nama_pemohon])
            ->andFilterWhere(['like', 'nama_penerima', $this->nama_penerima])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
            ->andFilterWhere(['like', 'masalah_dihadapi', $this->masalah_dihadapi])
            ->andFilterWhere(['like', 'lokasi_kejadian', $this->lokasi_kejadian])
            ->andFilterWhere(['like', 'jenis_bantuan_lain_yang_diterima', $this->jenis_bantuan_lain_yang_diterima]);

        return $dataProvider;
    }
}
