<section id="body" class="container">
    <div class="h1-title"><?=$APPLICATION->GetPageProperty('pre-h1')?></div>
    <h1><?=$APPLICATION->GetPageProperty('h1')?></h1>
    <div class="content">
        <div class="row row-f about">
            <div class="col-xs-12 col-md-3 post-left">
                <div class="title-preview">Данные</div>
                <p>
                    <strong>Имя</strong><br/><?$APPLICATION->IncludeFile('include/about-fio.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Дата рождения</strong><br/><?$APPLICATION->IncludeFile('include/about-birthday.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Адрес</strong><br/><?$APPLICATION->IncludeFile('include/about-address.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Телефон</strong><br/><?$APPLICATION->IncludeFile('include/about-phone.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Почта</strong><br/><?$APPLICATION->IncludeFile('include/about-email.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Сайт</strong><br/><?$APPLICATION->IncludeFile('include/about-site.php', false, ['MODE' => 'php'])?>
                </p>
                <p>
                    <strong>Социальные сети</strong><br/>
                    <?$APPLICATION->IncludeFile('include/about-socnet.php', false, ['MODE' => 'php'])?>
                </p>
            </div>
            <div class="col-xs-11 col-xs-offset-1 col-md-7 col-md-offset-1 post-right">
                <? $APPLICATION->IncludeComponent('local.core:about.history', '.default', []) ?>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent('local.core:about.gallery', '.default', [])?>
        <? $APPLICATION->IncludeComponent('local.core:about.serf', '.default', [])?>
    </div>
</section>