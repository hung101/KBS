<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusGeranJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_geran_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_geran_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-geran-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
