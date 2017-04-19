<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefNamaJus */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::nama_jus;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::nama_jus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-jus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
