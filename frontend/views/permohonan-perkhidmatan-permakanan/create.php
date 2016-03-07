<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanPermakanan */

$this->title = GeneralLabel::createTitle . ' Permohonan Perkhidmatan Permakanan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Perkhidmatan Permakanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-permakanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
