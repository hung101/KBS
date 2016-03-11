<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLaporanEBantuan */

$this->title = 'Create Ref Laporan Ebantuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Laporan Ebantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-laporan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
