<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatih */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::peningkatan_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
