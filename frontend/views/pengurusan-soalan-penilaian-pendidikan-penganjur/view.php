<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanSoalanPenilaianPendidikanPenganjur */

$this->title = $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_soalan_penilaian_pendidikan_penganjurs, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-soalan-penilaian-pendidikan-penganjur-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pengurusan_soalan_penilaian_pendidikan_penganjur_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'pengurusan_soalan_penilaian_pendidikan_penganjur_id',
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id',
            'soalan',
            'rating',
        ],
    ]);*/ ?>

</div>
