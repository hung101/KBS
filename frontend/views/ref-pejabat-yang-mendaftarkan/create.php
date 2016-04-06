<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPejabatYangMendaftarkan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pejabat_yang_mendaftarkan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pejabat_yang_mendaftarkan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pejabat-yang-mendaftarkan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
