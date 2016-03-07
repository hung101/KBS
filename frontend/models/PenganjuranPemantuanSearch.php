<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenganjuranPemantuan;

/**
 * PenganjuranPemantuanSearch represents the model behind the search form about `app\models\PenganjuranPemantuan`.
 */
class PenganjuranPemantuanSearch extends PenganjuranPemantuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_pemantuan_id', 'permohonan_pendahuluan_pelagai', 'menghantar_surat_cuti_tanpa', 'keperluan_bengkel_telah', 'membuat_tempahan_penginapan', 'membuat_tempahan_tempat_untuk', 'mengesahan_kehadiran_panel', 'mengesahan_pendaftaran_panel', 'memberi_taklimat', 'mengumpul_dan_membukukan', 'membuat_pelarasan_kewangan'], 'integer'],
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
        $query = PenganjuranPemantuan::find();

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
            'penganjuran_pemantuan_id' => $this->penganjuran_pemantuan_id,
            'permohonan_pendahuluan_pelagai' => $this->permohonan_pendahuluan_pelagai,
            'menghantar_surat_cuti_tanpa' => $this->menghantar_surat_cuti_tanpa,
            'keperluan_bengkel_telah' => $this->keperluan_bengkel_telah,
            'membuat_tempahan_penginapan' => $this->membuat_tempahan_penginapan,
            'membuat_tempahan_tempat_untuk' => $this->membuat_tempahan_tempat_untuk,
            'mengesahan_kehadiran_panel' => $this->mengesahan_kehadiran_panel,
            'mengesahan_pendaftaran_panel' => $this->mengesahan_pendaftaran_panel,
            'memberi_taklimat' => $this->memberi_taklimat,
            'mengumpul_dan_membukukan' => $this->mengumpul_dan_membukukan,
            'membuat_pelarasan_kewangan' => $this->membuat_pelarasan_kewangan,
        ]);

        return $dataProvider;
    }
}
