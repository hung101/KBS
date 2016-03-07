<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PeningkatanKerjayaJurulatih */

$this->title = 'Update Peningkatan Kerjaya Jurulatih: ' . ' ' . $model->peningkatan_kerjaya_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Peningkatan Kerjaya Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->peningkatan_kerjaya_jurulatih_id, 'url' => ['view', 'id' => $model->peningkatan_kerjaya_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peningkatan-kerjaya-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
