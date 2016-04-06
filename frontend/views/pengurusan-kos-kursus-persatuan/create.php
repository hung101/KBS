<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKosKursusPersatuan */

$this->title = GeneralLabel::tambah_pengurusan_perhimpunankem_kos;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_perhimpunankem_kos, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-perhimpunan-kem-kos-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
