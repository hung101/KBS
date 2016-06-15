<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Atlet;

/**
 * AtletSearch represents the model behind the search form about `app\models\Atlet`.
 */
class AtletSearch extends Atlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet_id', 'name_penuh', 'tarikh_lahir', 'tempat_lahir_bandar', 'tempat_lahir_negeri', 'bangsa', 'agama', 'jantina', 
                'taraf_perkahwinan', 'bahasa_ibu', 'no_sijil_lahir', 'ic_no', 'ic_no_lama', 'passport_no', 'passport_tempat_dikeluarkan', 
                'lesen_memandu_no', 'lesen_tamat_tempoh', 'jenis_lesen', 'emel', 'facebook', 'twitter', 'alamat_rumah_1', 'alamat_rumah_2', 
                'alamat_rumah_3', 'alamat_surat_menyurat_1','alamat_surat_menyurat_2','alamat_surat_menyurat_3','dari_bahagian', 'sumber', 
                'negeri_diwakili', 'nama_kecemasan', 'pertalian_kecemasan', 'tawaran'], 'safe'],
            [['umur', 'tel_bimbit_no_1', 'tel_bimbit_no_2', 'tel_no', 'tel_no_kecemasan', 'tel_bimbit_no_kecemasan'], 'integer'],
            [['tinggi', 'berat'], 'number'],
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
        $query = Atlet::find()
                ->joinWith(['refStatusTawaran']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*if($this->tawaran == "ya") {
            $this->tawaran = 1;
        } else if ($this->tawaran == "tidak") {
            $this->tawaran = 0;
        }*/

        $query->andFilterWhere([
            'tarikh_lahir' => $this->tarikh_lahir,
            'umur' => $this->umur,
            'tinggi' => $this->tinggi,
            'berat' => $this->berat,
            'lesen_tamat_tempoh' => $this->lesen_tamat_tempoh,
            'tel_bimbit_no_1' => $this->tel_bimbit_no_1,
            'tel_bimbit_no_2' => $this->tel_bimbit_no_2,
            'tel_no' => $this->tel_no,
            'tel_no_kecemasan' => $this->tel_no_kecemasan,
            'tel_bimbit_no_kecemasan' => $this->tel_bimbit_no_kecemasan,
            //'tawaran' => $this->tawaran,
        ]);

        $query->andFilterWhere(['like', 'atlet_id', $this->atlet_id])
            ->andFilterWhere(['like', 'name_penuh', $this->name_penuh])
            ->andFilterWhere(['like', 'tempat_lahir_bandar', $this->tempat_lahir_bandar])
            ->andFilterWhere(['like', 'tempat_lahir_negeri', $this->tempat_lahir_negeri])
            ->andFilterWhere(['like', 'bangsa', $this->bangsa])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'taraf_perkahwinan', $this->taraf_perkahwinan])
            ->andFilterWhere(['like', 'bahasa_ibu', $this->bahasa_ibu])
            ->andFilterWhere(['like', 'no_sijil_lahir', $this->no_sijil_lahir])
            ->andFilterWhere(['like', 'ic_no', $this->ic_no])
            ->andFilterWhere(['like', 'ic_no_lama', $this->ic_no_lama])
            ->andFilterWhere(['like', 'passport_no', $this->passport_no])
            ->andFilterWhere(['like', 'passport_tempat_dikeluarkan', $this->passport_tempat_dikeluarkan])
            ->andFilterWhere(['like', 'lesen_memandu_no', $this->lesen_memandu_no])
            ->andFilterWhere(['like', 'jenis_lesen', $this->jenis_lesen])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'alamat_rumah_1', $this->alamat_rumah_1])
            ->andFilterWhere(['like', 'alamat_rumah_2', $this->alamat_rumah_2])
            ->andFilterWhere(['like', 'alamat_rumah_3', $this->alamat_rumah_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'dari_bahagian', $this->dari_bahagian])
            ->andFilterWhere(['like', 'sumber', $this->sumber])
            ->andFilterWhere(['like', 'negeri_diwakili', $this->negeri_diwakili])
            ->andFilterWhere(['like', 'nama_kecemasan', $this->nama_kecemasan])
            ->andFilterWhere(['like', 'pertalian_kecemasan', $this->pertalian_kecemasan])
                ->andFilterWhere(['like', 'tbl_ref_status_tawaran.desc', $this->tawaran]);

        return $dataProvider;
    }
}
