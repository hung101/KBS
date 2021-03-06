<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlTemujanji;

/**
 * PlTemujanjiSearch represents the model behind the search form about `app\models\PlTemujanji`.
 */
class PlTemujanjiSearch extends PlTemujanji
{
    public $atlet;
    public $atlet_ic;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_temujanji_id', 'atlet', 'atlet_ic'], 'integer'],
            [['tarikh_temujanji', 'doktor_pegawai_perubatan', 'jenis_sukan', 'makmal_perubatan', 'status_temujanji', 'pegawai_yang_bertanggungjawab', 
                'catitan_ringkas', 'catatan_tambahan', 'atlet_id', 'kategori_atlet', 'kehadiran_pesakit'], 'safe'],
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
        $query = PlTemujanji::find()
                ->joinWith(['refStatusTemujanjiPesakitLuar'])
                ->joinWith(['refPegawaiPerubatan'])
                ->joinWith(['refSukan'])
                ->joinWith(['refProgramSemasaSukanAtlet'])
                ->joinWith(['refStatusKehadiran'])
                ->joinWith(['refJenisTemujanjiPesakitLuar'])
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
            'pl_temujanji_id' => $this->pl_temujanji_id,
            //'atlet_id' => $this->atlet_id,
            //'tarikh_temujanji' => $this->tarikh_temujanji,
            'tbl_pl_temujanji.atlet_id' => $this->atlet,
            //'tbl_atlet.ic_no' => $this->atlet_ic,
        ]);

        $query->andFilterWhere(['like', 'doktor_pegawai_perubatan', $this->doktor_pegawai_perubatan])
            ->andFilterWhere(['like', 'tbl_ref_status_temujanji_pesakit_luar.desc', $this->status_temujanji])
            ->andFilterWhere(['like', 'tbl_ref_pegawai_perubatan.desc', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'catatan_tambahan', $this->catatan_tambahan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                ->andFilterWhere(['like', 'tbl_atlet.ic_no', $this->atlet_ic])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kehadiran_pesakit])
                ->andFilterWhere(['like', 'tbl_ref_jenis_temujanji_pesakit_luar.desc', $this->makmal_perubatan])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->kategori_atlet])
                ->andFilterWhere(['like', 'tarikh_temujanji', $this->tarikh_temujanji]);

        return $dataProvider;
    }
}
