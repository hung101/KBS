<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */

//$this->title = $model->pengurusan_pemantauan_dan_penilaian_jurulatih_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pemantauan_jurulatih;
if($jurulatih_id!=null){
    $this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemantauan_jurulatih, 'url' => ['index','jurulatih_id'=>$jurulatih_id]];
} else {
    $this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemantauan_jurulatih, 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laporan-pemantauan-jurulatih-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['update']) && $model->created_by == Yii::$app->user->identity->id): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->laporan_pemantauan_jurulatih_id,'jurulatih_id'=>$jurulatih_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['delete']) && $model->created_by == Yii::$app->user->identity->id): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->laporan_pemantauan_jurulatih_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['laporan-pemantauan-jurulatih']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->laporan_pemantauan_jurulatih_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelLaporanPemantauanJurulatihKategori' => $searchModelLaporanPemantauanJurulatihKategori,
        'dataProviderLaporanPemantauanJurulatihKategori' => $dataProviderLaporanPemantauanJurulatihKategori,
        'readonly' => $readonly,
        'jurulatih_id' => $jurulatih_id,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id',
            'nama_jurulatih_dinilai',
            'nama_sukan',
            'nama_acara',
            'pusat_latihan',
        ],
    ]);*/ ?>

</div>
