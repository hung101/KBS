<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanMenghadiriProgramAntarabangsa */

$this->title = 'Create Ref Peringkat Bantuan Menghadiri Program Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Menghadiri Program Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-bantuan-menghadiri-program-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
