<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTemujanjiRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_temujanji_rehabilitasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_temujanji_rehabilitasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-temujanji-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
