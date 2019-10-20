<?

namespace Local\Core\Inner\BxModified;

/**
 * Модифицированный класс \CBitrixComponent
 *
 * @see     \CBitrixComponent
 * @inheritdoc
 * @package Local\Core\Inner\BxModified
 */
class CBitrixComponent extends \CBitrixComponent
{
    /**
     * Выводит страницу 404
     *
     * @param string $strMessage Сообщение
     *
     * @throws \Bitrix\Main\LoaderException
     */
    protected function _show404Page($strMessage = '')
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        \Bitrix\Iblock\Component\Tools::process404($strMessage, true, true, true, "");
    }
}