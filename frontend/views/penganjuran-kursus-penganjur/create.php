<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPenganjur */

$this->title = GeneralLabel::createTitle . ' Penganjuran Kursus : Penganjur';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus : Penganjur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-penganjur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
