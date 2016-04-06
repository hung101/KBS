<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriELaporan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_elaporan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_elaporans, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
