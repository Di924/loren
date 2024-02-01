var slides = document.querySelectorAll('#slides .slide');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide,2000);
 
function nextSlide() {
    slides[currentSlide].className="slide";
    currentSlide = (currentSlide+1)%slides.length;
    slides[currentSlide].className = "slide showing";
}


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