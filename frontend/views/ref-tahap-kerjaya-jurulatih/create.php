<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapKerjayaJurulatih */

$this->title = 'Create Ref Tahap Kerjaya Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Kerjaya Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-kerjaya-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
