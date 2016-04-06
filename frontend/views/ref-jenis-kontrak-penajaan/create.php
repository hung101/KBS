<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKontrakPenajaan */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kontrak Penajaan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kontrak Penajaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kontrak-penajaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
