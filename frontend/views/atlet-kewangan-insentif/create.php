<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganInsentif */

$this->title = GeneralLabel::createTitle . ' '. GeneralLabel::insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
