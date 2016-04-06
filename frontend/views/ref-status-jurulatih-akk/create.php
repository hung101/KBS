<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJurulatihAkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::status_jurulatih_akk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::status_jurulatih_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-jurulatih-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
