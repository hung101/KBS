<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AdminEBiasiswa */

$this->title = GeneralLabel::admin_audit_log;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-ebiasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <iframe src="<?php echo Url::to(['/audit/trail']);?>" width="1500px" height="1570px" frameBorder="0"></iframe> 

</div>
