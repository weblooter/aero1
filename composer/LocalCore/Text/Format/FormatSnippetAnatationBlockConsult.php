<?php


namespace Local\Core\Text\Format;

/**
 * Class FormatSnippetAnatationBlock
 *
 * Форматирует снипет блока анатации
 *
 * @package Local\Core\Text\Format
 */
class FormatSnippetAnatationBlockConsult extends BaseFormat
{
    public function format($strText)
    {
        $strText = parent::format($strText);
        $strText = (new FormatNewLine())->format($strText);

        if (preg_match_all('/(\{\{ANATATIONBLOCKCONSULT\}\}(.*?)\{\{\/ANATATIONBLOCKCONSULT\}\})/', $strText, $arAnatationBlockMatches) > 0) {
            $arAnatationBlockMatches[0] = array_unique($arAnatationBlockMatches[0]);

            $arReplaceFrom = $arAnatationBlockMatches[0];
            $arReplaceTo = [];


            foreach ($arAnatationBlockMatches[0] as $arAnatationBlockMatch) {
                preg_match('/{{TITLE}}([^{]+){{\/TITLE}}/', $arAnatationBlockMatch, $arTitleMatch);
                preg_match('/{{COLUMN1}}(.*?){{\/COLUMN1}}/', $arAnatationBlockMatch, $arColumn1);
                preg_match('/{{CONSULT_ID}}(.*?){{\/CONSULT_ID}}/', $arAnatationBlockMatch, $iConsultId);

                $arTmp = [
                    $arTitleMatch[1],
                    $arColumn1[1],
                    $iConsultId[1],
                ];

                list($strTitle, $strColumn1, $sConsultTags) = $arTmp;


                if ((int)$sConsultTags > 0) {
                    $rsTags = \CIBlockSection::GetList([
                        'SORT' => 'ASC'
                    ], [
                        'IBLOCK_ID' => \Local\Core\Assistant\Iblock::getIdByCode('main_ved', 'consult'),
                        'SECTION_ID' => $sConsultTags,
                        'ACTIVE' => 'Y'
                    ], false, [
                        'ID',
                        'IBLOCK_ID',
                        'NAME',
                        'SECTION_PAGE_URL',
                    ]);
                    if ($rsTags->SelectedRowsCount() > 0) {
                        $sConsultTags = '<p>Часто задаваемые вопросы для вашего удобства разбиты по тегам:<br/>';
                        while ($aTag = $rsTags->GetNext()) {
                            $sConsultTags .= '<a style="text-decoration:none;" href="'.$aTag['SECTION_PAGE_URL'].'">'.$aTag['NAME'].'</a> ';
                        }
                        $sConsultTags .= '</p>
<p style="font-size: 14px; color: #032a58; line-height: normal;">* для более полной индивидуальной консультации вам необходимо записаться на прием к доктору.</p>';
                    } else {
                        $sConsultTags = '';
                    }
                } else {
                    $sConsultTags = '';
                }


                $arReplaceTo[] = <<<DOCHERE
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="title-preview">$strTitle</div>
        $strColumn1
    </div>
    <div class="col-xs-12 col-md-6">
        $sConsultTags
    </div>
</div>
DOCHERE;
            }

            $strText = str_replace($arReplaceFrom, $arReplaceTo, $strText);
        }

        return $strText;
    }
}