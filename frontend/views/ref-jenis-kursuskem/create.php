<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKursuskem */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kursuskem;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kursuskem, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kursuskem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
