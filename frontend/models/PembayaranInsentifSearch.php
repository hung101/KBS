<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranInsentif;

/**
 * PembayaranInsentifSearch represents the model behind the search form about `app\models\PembayaranInsentif`.
 */
class PembayaranInsentifSearch extends PembayaranInsentif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembayaran_insentif_id', 'rekod_baharu', 'created_by', 'updated_by'], 'integer'],
            [['kejohanan', 'jenis_insentif', 'pingat', 'kumpulan_temasya_kejohanan', 'kelulusan', 'tarikh_kelulusan', 'tarikh_pembayaran_insentif', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = PembayaranInsentif::find()
                ->joinWith(['refJenisInsentif'])
                ->joinWith(['refPingatInsentif'])
                ->joinWith(['refPengurusanInsentifTetapanShakamShakar'])
                ->joinWith(['refKelulusan']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pembayaran_insentif_id' => $this->pembayaran_insentif_id,
            //'jenis_insentif' => $this->jenis_insentif,
            //'pingat' => $this->pingat,
            //'kumpulan_temasya_kejohanan' => $this->kumpulan_temasya_kejohanan,
            'rekod_baharu' => $this->rekod_baharu,
            'jumlah' => $this->jumlah,
            'tarikh_kelulusan' => $this->tarikh_kelulusan,
            'tarikh_pembayaran_insentif' => $this->tarikh_pembayaran_insentif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kejohanan', $this->kejohanan])
                ->andFilterWhere(['like', 'tbl_ref_jenis_insentif.desc', $this->jenis_insentif])
                ->andFilterWhere(['like', 'tbl_ref_pingat_insentif.desc', $this->pingat])
                ->andFilterWhere(['like', 'tbl_ref_pengurusan_insentif_tetapan_shakam_shakar.desc', $this->kumpulan_temasya_kejohanan])
            ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan]);

        return $dataProvider;
    }
}