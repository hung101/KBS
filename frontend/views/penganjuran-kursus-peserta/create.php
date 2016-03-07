<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPeserta */

$this->title = GeneralLabel::createTitle . ' Penganjuran Kursus Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus : Senarai Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
