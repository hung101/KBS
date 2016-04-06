<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKelayakanJaringanAntarabangsa */

//$this->title = $model->pengurusan_kelayakan_jaringan_antarabangsa_id;
$this->title = GeneralLabel::viewTitle . ' Pengurusan Kelayakan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kelayakan_jaringan_antarabangsa, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kelayakan-jaringan-antarabangsa-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->pengurusan_kelayakan_jaringan_antarabangsa_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->pengurusan_kelayakan_jaringan_antarabangsa_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pengurusan_kelayakan_jaringan_antarabangsa_id',
            'pengurusan_jaringan_antarabangsa_id',
            'nama_kursus',
            'tarikh',
            'tempat',
            'tahap_kelayakan',
        ],
    ]);*/ ?>

</div>
