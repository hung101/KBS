<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatELaporan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_elaporan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_elaporan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-elaporan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
