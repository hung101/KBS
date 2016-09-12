<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanBantuanMenghadiriProgramAntarabangsa */

$this->title = 'Update Ref Jawatan Bantuan Menghadiri Program Antarabangsa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Bantuan Menghadiri Program Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawatan-bantuan-menghadiri-program-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
