<?php

use yii\web\ErrorHandler;

$message = ErrorHandler::convertExceptionToString($exception);
$this->title = $message;
?>
<div class="error-page">
    <h2 class="headline text-red"><?= $exception->statusCode ?></h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-red"></i> <?= $message ?></h3>
        <p><?= Yii::t('app/error', 'We will work on fixing that right away. you may try using the search form'); ?></p>
        <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
