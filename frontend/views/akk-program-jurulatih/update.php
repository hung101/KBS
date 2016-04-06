<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatih */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::akk_program_jurulatih.': ' . ' ' . $model->akk_program_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::peningkatan_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['view', 'id' => $model->akk_program_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
