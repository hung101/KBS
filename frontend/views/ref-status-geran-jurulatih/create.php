<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusGeranJurulatih */

$this->title = 'Create Ref Status Geran Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Geran Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-geran-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
