<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatih */

//$this->title = 'Update Akk Program Jurulatih: ' . ' ' . $model->akk_program_jurulatih_id;
$this->title = GeneralLabel::updateTitle . ' Peningkatan Kerjaya Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Peningkatan Kerjaya Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Peningkatan Kerjaya Jurulatih', 'url' => ['view', 'id' => $model->akk_program_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
