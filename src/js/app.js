
document.addEventListener('DOMContentLoaded', function()  {
    eventListeners();

});

function eventListeners() {

    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
//Muestra campos condicionales 


const MetodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]'); 
MetodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))

}

function navegacionResponsive() {
    
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}

function mostrarMetodosContacto(e) {
 const contactoDiv = document.querySelector('#contacto')
 console.log(e)
if(e.target.value === 'telefono') {
     contactoDiv.innerHTML = `
     <label for="telefono">Teléfono</label>
     <input type="tel" placeholder="Tu Teléfono" id="telefono"  name="contacto[telefono]">
     
     <p>Elija la fecha y la hora para la llamada</p>

     <label for="fecha">Fecha:</label>
     <input type="date" id="fecha" name="contacto[fecha]">

     <label for="hora">Hora:</label>
     <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
     `
}else {
    contactoDiv.innerHTML = `
    <label for="email">E-mail</label>
    <input type="email" placeholder="Tu Email" id="email"  name="contacto[email]" required>s
    `; 
}

}