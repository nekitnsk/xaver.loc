var cyrtolat = function(){
 var res='';
 var text=document.getElementById('name').value;
 var transl={А:'a', а:'a', Б:'b', б:'b', В:'v', в:'v', Г:'g', г:'g',
 Д:'d', д:'d', Е:'e', е:'e', Ё:'yo', ё:'yo', Ж:'zh', ж:'zh', З:'z', з:'z',
 И:'i', и:'i', Й:'j', й:'j', К:'k', к:'k', Л:'l', л:'l', М:'m', м:'m',
 Н:'n', н:'n', О:'o', о:'o', П:'p', п:'p', Р:'r', р:'r', С:'s', с:'s',
 Т:'t', т:'t', У:'u', у:'u', Ф:'f', ф:'f', Х:'x', х:'x', Ц:'cz', ц:'cz',
 Ч:'ch', ч:'ch', Ш:'sh', ш:'sh', Щ:'shh', щ:'shh', Ъ:'"', ъ:'"', Ы:'y', ы:'y',
 Ь:'', ь:'', Э:'e', э:'e',  Ю:'yu', ю:'yu', Я:'ya', я:'ya', ' ':'-'};

 for(i=0;i<text.length;i++) {
    if(transl[text[i]]!=undefined) res+=transl[text[i]];
    else res+=text[i];
 }
 res=res.replace(/Cz(?=i|e|y|j|I|E|Y|J)/g, "c");
 res=res.replace(/cz(?=i|e|y|j|I|E|Y|J)/g, "c");
 document.getElementById('seo_name').value=res.replace(/-+/g,'-');
}
