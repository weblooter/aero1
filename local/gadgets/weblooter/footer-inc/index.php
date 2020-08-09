<?

use Bitrix\Main\Application;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$obRequest = Application::getInstance()
    ->getContext()
    ->getRequest();
if ($obRequest->getPost('WEBLOOTER_FOOTER_INC_SAVE') === 'Y' && check_bitrix_sessid()) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.footer-inc.text', $obRequest->getPost('WEBLOOTER_FOOTER_INC_TEXT'));
    Application::getInstance()
        ->getContext()
        ->getResponse()
        ->addHeader('Location', $obRequest->getRequestUri());
}

?>
<div class="bx-gadgets-info">
    <br />
    <div class="bx-gadgets-content-padding-rl adm-workarea">
        <form action="" method="post">
            <?=bitrix_sessid_post()?>
            <table class="bx-gadgets-info-site-table">
                <tr>
                    <td>
                        <textarea name="WEBLOOTER_FOOTER_INC_TEXT" style="width: 100%; min-height: 350px; resize: vertical;"><?
                            include $_SERVER['DOCUMENT_ROOT'].'/.footer-inc.text' ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br />
                        <button class="adm-btn adm-btn-save" name="WEBLOOTER_FOOTER_INC_SAVE" value="Y">Сохранить</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <br />
</div>