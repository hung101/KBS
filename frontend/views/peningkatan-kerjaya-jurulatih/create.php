<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PeningkatanKerjayaJurulatih */

$this->title = 'Tambah Peningkatan Kerjaya Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Peningkatan Kerjaya Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peningkatan-kerjaya-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
