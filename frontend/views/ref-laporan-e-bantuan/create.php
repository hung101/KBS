<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLaporanEBantuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::laporan_ebantuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_ebantuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-laporan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
