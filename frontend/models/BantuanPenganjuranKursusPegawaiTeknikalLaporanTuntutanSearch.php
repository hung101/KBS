<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch represents the model behind the search form about `app\models\BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan`.
 */
class BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutanSearch extends BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id', 'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id', 'created_by', 'updated_by'], 'integer'],
            [['kejohanan_kursus_seminar_bengkel', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'no_cek', 'no_boucer', 'session_id', 'created', 'updated'], 'safe'],
            [['jumlah_kelulusan', 'pendahuluan_80', 'jumlah_yang_dituntut_20'], 'number'],
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
        $query = BantuanPenganjuranKursusPegawaiTeknikalLaporanTuntutan::find();

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
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_tuntutan_id,
            'bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_laporan_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'jumlah_kelulusan' => $this->jumlah_kelulusan,
            'pendahuluan_80' => $this->pendahuluan_80,
            'jumlah_yang_dituntut_20' => $this->jumlah_yang_dituntut_20,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kejohanan_kursus_seminar_bengkel', $this->kejohanan_kursus_seminar_bengkel])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'no_cek', $this->no_cek])
            ->andFilterWhere(['like', 'no_boucer', $this->no_boucer])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
