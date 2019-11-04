<section class="contacts container content post-up">
    <div class="row row-f">
        <div class="col-xs-12 col-md-6">
            <div class="title-preview"><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-text-1.php', false, ['MODE' => 'text'])?></div>
            <h2><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-text-2.php', false, ['MODE' => 'text'])?></h2>
            <div class="social">
                <?$GLOBALS['APPLICATION']->IncludeComponent('local.core:contacts.socialnet', '.default', [], false, ['HIDE_ICONS' => 'Y'])?>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 contacts__item">
            <p>
                <strong>Адрес</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-address.php', false, ['MODE' => 'html'])?>
            </p>
            <p>
                <strong>Телефон</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-address.php', false, ['MODE' => 'html'])?>
            </p>
            <p>
                <strong>Режим работы</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-work-time.php', false, ['MODE' => 'html'])?>
            </p>
            <p>
                <strong>Маркетинг и PR</strong><br /><? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-emails.php', false, ['MODE' => 'html'])?>
            </p>
        </div>
    </div>
    <div class="map">
        <? $GLOBALS['APPLICATION']->IncludeFile('include/contacts-map.php', false, ['MODE' => 'html'])?>
    </div>
</section>