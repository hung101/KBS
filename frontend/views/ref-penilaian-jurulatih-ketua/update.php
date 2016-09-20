<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianJurulatihKetua */

$this->title = GeneralLabel::updateTitle.' Penilaian Jurulatih Ketua: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Jurulatih Ketua', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="ref-penilaian-jurulatih-ketua-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
