<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKomposisiPenyertaan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_komposisi_penyertaan.': ' . ' ' . $model->elaporan_komposisi_penyertaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_komposisi_penyertaans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_komposisi_penyertaan_id, 'url' => ['view', 'id' => $model->elaporan_komposisi_penyertaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-komposisi-penyertaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
