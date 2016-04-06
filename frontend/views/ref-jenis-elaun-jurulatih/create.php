<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisElaunJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_elaun_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_elaun_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-elaun-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
