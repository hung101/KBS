<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MuatNaikDokumen;

/**
 * MuatNaikDokumenSearch represents the model behind the search form about `app\models\MuatNaikDokumen`.
 */
class MuatNaikDokumenSearch extends MuatNaikDokumen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['muat_naik_dokumen_id'], 'integer'],
            [['kategori_muat_naik', 'tarikh_muat_naik', 'temasya', 'tarikh_mula', 'tarikh_tamat', 'catatan'], 'safe'],
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
        $query = MuatNaikDokumen::find()
                ->joinWith(['refKategoriMuatnaik'])
                ->joinWith(['refPengurusanJawatankuasaKhasSukanMalaysia']);

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
            'muat_naik_dokumen_id' => $this->muat_naik_dokumen_id,
            'tarikh_muat_naik' => $this->tarikh_muat_naik,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_muatnaik.desc', $this->kategori_muat_naik])
            ->andFilterWhere(['like', 'muat_naik_dokumen', $this->muat_naik_dokumen])
                //->andFilterWhere(['like', 'temasya', $this->temasya])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
                ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_pengurusan_jawatankuasa_khas_sukan_malaysia.temasya', $this->temasya]);

        return $dataProvider;
    }
}
