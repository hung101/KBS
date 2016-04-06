<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKewanganSumber */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kewangan_sumber;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kewangan_sumber, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kewangan-sumber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
