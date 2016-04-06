<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefWaktuKetikaDiperlukanSukarelawan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::waktu_ketika_diperlukan_sukarelawan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::waktu_ketika_diperlukan_sukarelawan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-waktu-ketika-diperlukan-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
