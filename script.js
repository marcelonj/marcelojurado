const mensaje = "Hola mundo! soy Marcelo, el desarrollador PHP fullstack que buscabas";
const divMensaje = document.getElementById("mensaje");
const divs= document.querySelectorAll("div");
const contador_mensaje = document.getElementById("contador-mensaje");
const textarea_mensaje = document.getElementById("textarea-mensaje");

function alternar(elemento, estado){
    if(estado){
        alt.innerHTML= ".";
        estado= false;
        setTimeout(alternar, 800, elemento, estado);
    }
    else{
        alt.innerHTML= "_";
        estado= true;
        setTimeout(alternar, 800, elemento, estado);
    }
}

function maquina_de_escribir(por_escribir, escrito) {
    if(por_escribir != ""){
        escrito= escrito+por_escribir[0];
        por_escribir= por_escribir.slice(1);
        divMensaje.innerHTML= escrito;
        setTimeout(maquina_de_escribir, 70, por_escribir, escrito);
    }
    else{
        divMensaje.innerHTML= escrito+'<span id="alt"></div>';
        let alt= document.getElementById("alt");
        let estado= false;
        alternar(alt, estado);
    }
}

function borrar_banner(){
    let divs= document.querySelectorAll("div");
    if(divs[divs.length-1].className == ""){
        divs[divs.length-1].style= "display: none;"
    }
}

function contador_mensaje_func(){
    contador_mensaje.innerHTML= textarea_mensaje.value.length+" / 300"
}

textarea_mensaje.addEventListener("input", contador_mensaje_func);

maquina_de_escribir(mensaje,"");
setTimeout(borrar_banner,1000);