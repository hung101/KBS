<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\KursusPersatuan */

//$this->title = $model->kursus_persatuan_id;
$this->title = GeneralLabel::viewTitle . ' Kursus Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Kursus Persatuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-persatuan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['kursus-persatuan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->kursus_persatuan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['MSN']['kursus-persatuan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->kursus_persatuan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'searchModelTempahanKursusPersatuan' => $searchModelTempahanKursusPersatuan,
        'dataProviderTempahanKursusPersatuan' => $dataProviderTempahanKursusPersatuan,
        'searchModelPengurusanKosKursusPersatuan' => $searchModelPengurusanKosKursusPersatuan,
        'dataProviderPengurusanKosKursusPersatuan' => $dataProviderPengurusanKosKursusPersatuan,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kursus_persatuan_id',
            'nama_kursus',
            'tarikh',
            'activiti',
            'tempat',
            'pegawai_terlibat',
        ],
    ]);*/ ?>

</div>
