

const validarPassword=(password)=>{
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}/.test(password.trim());

}

const validarCorreo=(correo)=>{
    return  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ .test(correo.trim());

}

const validarNombre=(nombre)=>{
    return /^[A-Z]+$/i.test(nombre.trim());

}