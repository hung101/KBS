<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisJus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_jus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_jus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-jus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
