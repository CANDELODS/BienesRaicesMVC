document.addEventListener('DOMContentLoaded', function(){

    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)'); //Dependiendo del usuario
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function (params) { //Preferencias en auto
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function name(params) {
        document.body.classList.toggle('dark-mode');
    });

}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive)

    //Muestra Campos Condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]'); //Selecciono Todos Los Elementos
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto)) //Itero Cada Uno De Esos Elementos Y A Cada Input De Ese Tipo Le Damos El Evento 'click'

}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar'); //Si tiene la clase la quita, y si no la tiene la agrega

    /*if(navegacion.classList.contains('mostrar')){ Manera Larga
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');

    }
    */
}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Numero De Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

        <p>Elija La Fecha Y La Hora Para La Llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    }else{
        contactoDiv.innerHTML = `
        <label for="email">Correo Electronico</label>
        <input type="email" placeholder="Tu Correo" id="email" name="contacto[email]" required>
        `;
    }

}