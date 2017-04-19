<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefLokasiPengurusanKemudahan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::lokasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lokasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lokasi-pengurusan-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
