<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianPendidikanPenganjurIntructor */

//$this->title = $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id;
$this->title = GeneralLabel::viewTitle . ' ' . GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-pendidikan-penganjur-intructor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
		<?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penilaian-pendidikan-penganjur-intructor']['update'])): ?>
            <?= Html::a(GeneralLabel::cetak, ['print', 'id' => $model->pengurusan_penilaian_pendidikan_penganjur_intructor_id], ['class' => 'btn btn-info', 'target' => '_blank']) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
        'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id',
            'nama_penganjuran_kursus',
            'kod_kursus',
            'tarikh_kursus',
            'instructor',
        ],
    ]);*/ ?>

</div>
