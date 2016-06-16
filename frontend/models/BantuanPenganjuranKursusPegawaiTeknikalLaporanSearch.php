<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch represents the model behind the search form about `app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporan`.
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporanSearch extends BantuanPenganjuranKursusPegawaiTeknikalLaporan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id', 'bilangan_pasukan', 'bilangan_peserta', 'bilangan_pegawai_teknikal', 'bilangan_pembantu', 'created_by', 'updated_by'], 'integer'],
            [['tarikh', 'tempat', 'tujuan_kursus_kejohanan', 'laporan_bergambar', 'penyata_perbelanjaan_resit_yang_telah_disahkan', 'jadual_keputusan_pertandingan', 'senarai_peserta', 'statistik_penyertaan', 'senarai_pegawai_penceramah', 'senarai_urusetia_sukarelawan', 'created', 'updated'], 'safe'],
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
        $query = BantuanPenganjuranKursusPegawaiTeknikalLaporan::find();

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
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id,
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
            ->andFilterWhere(['like', 'tujuan_kursus_kejohanan', $this->tujuan_kursus_kejohanan])
            ->andFilterWhere(['like', 'laporan_bergambar', $this->laporan_bergambar])
            ->andFilterWhere(['like', 'penyata_perbelanjaan_resit_yang_telah_disahkan', $this->penyata_perbelanjaan_resit_yang_telah_disahkan])
            ->andFilterWhere(['like', 'jadual_keputusan_pertandingan', $this->jadual_keputusan_pertandingan])
            ->andFilterWhere(['like', 'senarai_peserta', $this->senarai_peserta])
            ->andFilterWhere(['like', 'statistik_penyertaan', $this->statistik_penyertaan])
            ->andFilterWhere(['like', 'senarai_pegawai_penceramah', $this->senarai_pegawai_penceramah])
            ->andFilterWhere(['like', 'senarai_urusetia_sukarelawan', $this->senarai_urusetia_sukarelawan]);

        return $dataProvider;
    }
}
