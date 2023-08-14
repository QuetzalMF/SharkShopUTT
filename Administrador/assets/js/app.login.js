

const registrarUsuario= async()=>{
    var correo=document.querySelector("#correo").value;
    var password=document.querySelector("#password").value;
    var nombre=document.querySelector("#nombre").value;

    
    if
    (
    correo.trim()==='' ||
    password.trim()==='' ||
    nombre.trim()===''
    )
    {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Faltan datos',
        footer: 'Completa el formulario:)'
      })
      return;
    }
    
    if(!validarCorreo(correo)){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Introduce un correo electrónico válido',
        footer: 'Ejemplo: tunombre@gmail.com'
      })
      return;
    }

    if(!validarPassword(password)){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Introduce una contraseña válida',
        footer: 'Mínimo 8 caracteres, máximo 15. Al menos 1 letra mayúscula, 1 minúscula, 1 caracter especial'
      })
      return;
    }

    if(!validarNombre(nombre)){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Introduce un nombre válido',
        footer: 'Solo letras, solo un nombre, sin espacios'
      })
      return;
    }



    //INSERTAR DATOS EN BD ejpainterfaces
    const datos=new FormData();
    datos.append("correo",correo);
    datos.append("password",password);
    datos.append("nombre",nombre);


    var respuesta=await fetch("php/usuario/registrarUsuario.php", {
      method:'POST',
      body:datos
    });
    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: 'RESPUESTA'+respuesta
    })
    return;



}
