<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPermohonanKursusPersatuanPenasihat;

/**
 * PengurusanPermohonanKursusPersatuanPenasihatSearch represents the model behind the search form about `app\models\PengurusanPermohonanKursusPersatuanPenasihat`.
 */
class PengurusanPermohonanKursusPersatuanPenasihatSearch extends PengurusanPermohonanKursusPersatuanPenasihat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_permohonan_kursus_persatuan_penasihat_id', 'pengurusan_permohonan_kursus_persatuan_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula_bertugas', 'tarikh_tamat_bertugas', 'created', 'updated', 'nama', 'silibus', 'session_id'], 'safe'],
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
        $query = PengurusanPermohonanKursusPersatuanPenasihat::find()
                ->joinWith(['refProfilPanelPenasihatKpsk'])
                ->joinWith(['refSilibus']);

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
            'pengurusan_permohonan_kursus_persatuan_penasihat_id' => $this->pengurusan_permohonan_kursus_persatuan_penasihat_id,
            'pengurusan_permohonan_kursus_persatuan_id' => $this->pengurusan_permohonan_kursus_persatuan_id,
            //'nama' => $this->nama,
            'tarikh_mula_bertugas' => $this->tarikh_mula_bertugas,
            'tarikh_tamat_bertugas' => $this->tarikh_tamat_bertugas,
            //'silibus' => $this->silibus,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'session_id' => $this->session_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_profil_panel_penasihat_kpsk.nama', $this->nama])
                ->andFilterWhere(['like', 'silibus', $this->silibus]);

        return $dataProvider;
    }
}
