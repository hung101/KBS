<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PeningkatanKerjayaJurulatih */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::peningkatan_kerjaya_jurulatih.': ' . ' ' . $model->peningkatan_kerjaya_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peningkatan_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peningkatan_kerjaya_jurulatih_id, 'url' => ['view', 'id' => $model->peningkatan_kerjaya_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peningkatan-kerjaya-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
