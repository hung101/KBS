<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanBantuanMenghadiriProgramAntarabangsa */

$this->title = 'Create Ref Jawatan Bantuan Menghadiri Program Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Bantuan Menghadiri Program Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
