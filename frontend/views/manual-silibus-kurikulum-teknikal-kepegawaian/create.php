<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ManualSilibusKurikulumTeknikalKepegawaian */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
