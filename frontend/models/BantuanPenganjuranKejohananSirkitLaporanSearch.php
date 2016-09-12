<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKejohananSirkitLaporan;

/**
 * BantuanPenganjuranKejohananSirkitLaporanSearch represents the model behind the search form about `app\models\BantuanPenganjuranKejohananSirkitLaporan`.
 */
class BantuanPenganjuranKejohananSirkitLaporanSearch extends BantuanPenganjuranKejohananSirkitLaporan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_laporan_id', 'bantuan_penganjuran_kejohanan_id', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer'],
            [['tarikh', 'tempat', 'tujuan_penganjuran', 'laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_pasukan', 'senarai_statistik_penyertaan', 'senarai_pegawai_pembantu_teknikal', 'senarai_urusetia_sukarelawan', 'senarai_pegawai_pembantu_perubatan', 'created', 'updated'], 'safe'],
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
        $query = BantuanPenganjuranKejohananSirkitLaporan::find();

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
            'bantuan_penganjuran_kejohanan_laporan_id' => $this->bantuan_penganjuran_kejohanan_laporan_id,
            'bantuan_penganjuran_kejohanan_id' => $this->bantuan_penganjuran_kejohanan_id,
            'tarikh' => $this->tarikh,
            'bilangan_pasukan' => $this->bilangan_pasukan,
            'bilangan_peserta' => $this->bilangan_peserta,
            'bilangan_pegawai_teknikal' => $this->bilangan_pegawai_teknikal,
            'bilangan_pembantu' => $this->bilangan_pembantu,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tujuan_penganjuran', $this->tujuan_penganjuran])
            ->andFilterWhere(['like', 'laporan_bergambar', $this->laporan_bergambar])
            ->andFilterWhere(['like', 'penyata_perbelanjaan_resit_yang_telah_disahkan', $this->penyata_perbelanjaan_resit_yang_telah_disahkan])
            ->andFilterWhere(['like', 'jadual_keputusan_pertandingan', $this->jadual_keputusan_pertandingan])
            ->andFilterWhere(['like', 'senarai_pasukan', $this->senarai_pasukan])
            ->andFilterWhere(['like', 'senarai_statistik_penyertaan', $this->senarai_statistik_penyertaan])
            ->andFilterWhere(['like', 'senarai_pegawai_pembantu_teknikal', $this->senarai_pegawai_pembantu_teknikal])
            ->andFilterWhere(['like', 'senarai_urusetia_sukarelawan', $this->senarai_urusetia_sukarelawan])
            ->andFilterWhere(['like', 'senarai_pegawai_pembantu_perubatan', $this->senarai_pegawai_pembantu_perubatan]);

        return $dataProvider;
    }
}
