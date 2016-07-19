<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ManualSilibusKurikulumTeknikalKepegawaian */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::manual_silibus_kurikulum_teknikal_kepegawaian, 'url' => ['view', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
