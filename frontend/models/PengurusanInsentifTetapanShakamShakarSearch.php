<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanInsentifTetapanShakamShakar;

/**
 * PengurusanInsentifTetapanShakamShakarSearch represents the model behind the search form about `app\models\PengurusanInsentifTetapanShakamShakar`.
 */
class PengurusanInsentifTetapanShakamShakarSearch extends PengurusanInsentifTetapanShakamShakar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nilai_individu', 'nilai_berpasukan_kurang_5', 'nilai_berpasukan_lebih_5'], 'number'],
            [['pengurusan_insentif_tetapan_shakam_shakar_id', 'pengurusan_insentif_tetapan_id', 'created_by', 'updated_by'], 'integer'],
            [['kumpulan_temasya_kejohanan', 'session_id', 'jenis_insentif', 'pingat', 'rekod_baharu', 'created', 'updated', 'kejohanan', 'peringkat', 'kelas'], 'safe'],
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
        $query = PengurusanInsentifTetapanShakamShakar::find()
                ->joinWith(['refJenisInsentif'])
                ->joinWith(['refPingatInsentif'])
                ->joinWith(['refKelulusan'])
                ->joinWith(['refInsentifKejohanan'])
                ->joinWith(['refInsentifPeringkat'])
                ->joinWith(['refInsentifKelas']);

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
            'pengurusan_insentif_tetapan_shakam_shakar_id' => $this->pengurusan_insentif_tetapan_shakam_shakar_id,
            'pengurusan_insentif_tetapan_id' => $this->pengurusan_insentif_tetapan_id,
            //'jenis_insentif' => $this->jenis_insentif,
            //'pingat' => $this->pingat,
            //'rekod_baharu' => $this->rekod_baharu,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kumpulan_temasya_kejohanan', $this->kumpulan_temasya_kejohanan])
            ->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_ref_jenis_insentif.desc', $this->jenis_insentif])
                ->andFilterWhere(['like', 'rekod_baharu', $this->rekod_baharu])
                ->andFilterWhere(['like', 'tbl_ref_pingat_insentif.desc', $this->pingat])
                ->andFilterWhere(['like', 'tbl_ref_insentif_kejohanan.desc', $this->kejohanan])
                ->andFilterWhere(['like', 'tbl_ref_insentif_peringkat.desc', $this->peringkat])
                ->andFilterWhere(['like', 'tbl_ref_insentif_kelas.desc', $this->kelas])
                ->andFilterWhere(['like', 'nilai_individu', $this->nilai_individu])
                ->andFilterWhere(['like', 'nilai_berpasukan_kurang_5', $this->nilai_berpasukan_kurang_5])
                ->andFilterWhere(['like', 'nilai_berpasukan_lebih_5', $this->nilai_berpasukan_lebih_5]);

        return $dataProvider;
    }
}
