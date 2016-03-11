<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPermohonanJaringanAntarabangsa */

$this->title = 'Create Ref Permohonan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Permohonan Jaringan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-permohonan-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
