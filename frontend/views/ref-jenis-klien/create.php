<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKlien */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_klien;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::acara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-klien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
