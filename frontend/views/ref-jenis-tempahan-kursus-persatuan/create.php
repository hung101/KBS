<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTempahanKursusPersatuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_tempahan_kursus_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_tempahan_kursus_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-tempahan-kursus-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
