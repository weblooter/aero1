{"version":3,"sources":["dynamic_cards_form.js"],"names":["BX","namespace","Landing","UI","Form","DynamicCardsForm","data","BaseForm","apply","this","arguments","type","code","presets","sync","forms","id","replace","Utils","random","onSourceChangeHandler","onSourceChange","dynamicParams","settingFieldsSelectors","addField","createSourceField","createPagesField","detailPage","addCard","createFieldsGroup","createLinkField","prototype","constructor","__proto__","getSources","Main","getInstance","options","sources","getSourceItems","map","item","name","value","url","filter","sort","items","sortItem","sourceItems","source","isPlainObject","settings","Field","Source","selector","title","Loc","getMessage","onValueChange","field","getValue","find","setTimeout","bind","Pages","pagesCount","content","text","href","Link","textOnly","disableCustomURL","disableBlocks","disallowType","allowedTypes","LinkURL","TYPE_PAGE","detailPageMode","sourceField","fields","siteId","site_id","landingId","=TYPE","params","createUseSefField","Checkbox","multiple","checked","Card","DynamicFieldsGroup","isReference","isArray","some","references","reference","serialize","reduce","acc","includes","Dropdown","stubs","DynamicImage","src","alt","isString"],"mappings":"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","file":"dynamic_cards_form.map.js"}