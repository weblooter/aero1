{"version":3,"sources":["link_field.js"],"names":["BX","namespace","trim","Landing","Utils","clone","isPlainObject","decodeDataValue","fireCustomEvent","htmlToElement","style","escapeText","UI","Field","Link","data","BaseField","apply","this","arguments","options","remove","input","onValueChangeHandler","onValueChange","content","text","href","target","skipContent","customUrlDisabled","disableCustomURL","detailPageMode","containsImage","containsHtml","Text","placeholder","Loc","getMessage","selector","textOnly","getValue","bind","layout","hidden","header","hrefInput","LinkURL","title","onInput","onHrefInput","disallowType","disableBlocks","allowedTypes","sourceField","noHrefValueChange","targetInput","DropdownInline","className","items","_self","_blank","_popup","mediaButton","Button","BaseButton","html","onClick","onMediaClick","disabled","mediaLayout","create","props","mediaHelpButton","addEventListener","onMediaHelpButtonMouseover","onMediaHelpButtonMouseout","innerHTML","wrapper","createWrapper","left","createLeft","center","createCenter","right","createRight","appendChild","classList","add","adjustVideo","adjustEditLink","prototype","constructor","__proto__","superClass","type","getPlaceholderType","value","isString","length","getPageData","then","result","urlMask","Main","getInstance","params","sef_url","landing_view","replace","siteId","id","slice","call","querySelectorAll","forEach","editLink","createEditLink","children","attrs","isChanged","JSON","stringify","querySelector","element","matches","isAvailableMedia","isEnabledMedia","data-url","mediaService","getEmbedURL","getDynamic","firstElementChild","getAttribute","setValue","reset","enableMedia","enable","disable","closePopup","showMediaPreview","disableMedia","hideMediaPreview","hideMediaSettings","isEnabled","showMediaSettings","mediaSettings","getSettingsForm","ServiceFactory","MediaService","Factory","event","Tool","Suggest","show","description","outerHTML","angleOffset","hide","onVideoPreviewClick","$","fancybox","open","src","afterShow","instance","current","iframe","$slide","find","MediaPlayer","scrolling","loader","Loader","mode","offset","top","video","getURLPreviewElement","embedURL","getQueryParams","url"],"mappings":"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","file":"link_field.map.js"}