<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPelaksaanMajlis */

//$this->title = 'Update Anugerah Pelaksaan Majlis: ' . ' ' . $model->anugerah_pelaksaan_majlis_id;
$this->title = GeneralLabel::updateTitle . ' Anugerah Pelaksaan Majlis';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pelaksaan Majlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Anugerah Pelaksaan Majlis', 'url' => ['view', 'id' => $model->anugerah_pelaksaan_majlis_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pelaksaan-majlis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
