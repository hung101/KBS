<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Kursus */

$this->title = GeneralLabel::createTitle . ' CCE';
$this->params['breadcrumbs'][] = ['label' => 'Akademi Kejurulatihan Kebangsaan (AKK)', 'url' => ['akademi-akk/index']];
$this->params['breadcrumbs'][] = ['label' => 'CCE', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kursus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
