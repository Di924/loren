var modal = document.getElementById("my_modal");
var btn = document.getElementById("btn_modal_window");
var span = document.getElementById("close_modal");
var out = document.getElementById("btn_out");
out.onclick = function(){
    btn.style.display = "block";
    out.style.display = "none";
    document.location.href = "?exit";
}
btn.onclick = function(){
    modal.style.display = "block";
}
span.onclick = function(){
    modal.style.display = "none";
}
window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
}