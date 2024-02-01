function careshow(id) {
    // Если элемент с ID careid существует
    if(document.getElementById(id)) {
        // Создание массива Меню = id
        var idarr = ["idmain", "idbook", "idsearch", "idbooks"];
        // очищаем все блоки ID, кроме текущего
        for (var i = 0; i < idarr.length; i++) {
            if(id!=idarr[i]) {
                var objall = document.getElementById(idarr[i]);
                objall.style.display = "none"
            } else {
                // Записываем ссылку на элемент в obj
                var obj = document.getElementById(id)
                // Если css-свойство display не block, то: 
                if (obj.style.display !="block") {
                    obj.style.display = "block" // Показываем элемент
                }// end if
            }// end else
        }// end For
    }// end if 
}// end Function
function load(session){
    var btn = document.getElementById("btn_modal_window");
    var out = document.getElementById("btn_out");
    if(session){
        btn.style.display = "none";
        out.style.display = "block";
    }else{
        btn.style.display = "block";
        out.style.display = "none";
    }
}
console.log(load(session))