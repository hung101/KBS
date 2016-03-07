<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatih */

$this->title = GeneralLabel::createTitle . ' Peningkatan Kerjaya Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Peningkatan Kerjaya Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
