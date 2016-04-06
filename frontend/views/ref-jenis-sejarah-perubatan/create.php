<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisSejarahPerubatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_sejarah_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_sejarah_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-sejarah-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
