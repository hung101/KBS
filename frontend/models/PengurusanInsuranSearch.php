<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanInsuran;

/**
 * PengurusanInsuranSearch represents the model behind the search form about `app\models\PengurusanInsuran`.
 */
class PengurusanInsuranSearch extends PengurusanInsuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_insuran_id'], 'integer'],
            [['nama_insuran', 'tarikh_tuntutan', 'pegawai_yang_bertanggungjawab', 'atlet_id', 'tarikh_permohonan', 'status_permohonan'], 'safe'],
            [['jumlah_tuntutan'], 'number'],
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
        $query = PengurusanInsuran::find()
                ->joinWith(['atlet'])
                ->joinWith(['refStatusPermohonanInsuran']);

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
            'pengurusan_insuran_id' => $this->pengurusan_insuran_id,
            //'atlet_id' => $this->atlet_id,
            //'jumlah_tuntutan' => $this->jumlah_tuntutan,
            'tarikh_tuntutan' => $this->tarikh_tuntutan,
        ]);

        $query->andFilterWhere(['like', 'nama_insuran', $this->nama_insuran])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
                ->andFilterWhere(['like', 'tarikh_permohonan', $this->tarikh_permohonan])
                ->andFilterWhere(['like', 'jumlah_tuntutan', $this->jumlah_tuntutan])
                ->andFilterWhere(['like', 'tbl_ref_status_permohonan_insuran.desc', $this->status_permohonan]);

        return $dataProvider;
    }
}
