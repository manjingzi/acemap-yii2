<?php
$this->title = Yii::t('app/error', 'Oops! Page not found.');
?>
<div class="error-page">
    <h2 class="headline text-yellow"><?= $exception->statusCode ?></h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> <?= $this->title ?></h3>
        <p><?= Yii::t('app/error', 'We could not find the page you were looking for. you may try using the search form.'); ?></p>
        <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>