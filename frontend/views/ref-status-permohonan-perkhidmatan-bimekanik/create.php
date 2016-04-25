<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanPerkhidmatanBimekanik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_permohonan_perkhidmatan_bimekanik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_permohonan_perkhidmatan_bimekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-perkhidmatan-bimekanik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
