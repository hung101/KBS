<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatKongresDiLuarNegara */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::maklumat_kongres_di_luar_negara.': ' . ' ' . $model->maklumat_kongres_di_luar_negara_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_kongres_di_luar_negara, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->maklumat_kongres_di_luar_negara_id, 'url' => ['view', 'id' => $model->maklumat_kongres_di_luar_negara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maklumat-kongres-di-luar-negara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
