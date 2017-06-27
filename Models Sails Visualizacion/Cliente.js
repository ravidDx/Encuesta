/**
 * Cliente.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    cl_numeroCedula: {
      type: 'string'
    },
    cl_nombre: {
      type: 'string'
    },
    cl_apellido: {
        type: 'string'
    },
    cl_fechaNacimiento:'DATETIME',
    cl_celular: {
        type: 'string'
    },
    cl_correo: {
        type: 'email'
    },
    cl_contrasena: {
      	type: 'string'
    },
    cl_imagen:{
        type: 'string'
    },
    cl_saldo: {
        type: 'float'
    },
    cl_nivel: {
        type: 'integer'
    },
    cl_progreso:{
        type: 'integer'
    },
    //para asignar la experiencia 
    cl_experienciacliente: {
      type: 'string'
    },
    ac_publica:{
        model:'proveedor'
    },
    cl_cuentasBancarias:{
        collection:'cuentabancaria',
        via:'bc_contieneCuenta',
    },
    cl_transacciones:{
        collection:'transaccion',
        via:'tr_contieneTransaccion',
    },
    cl_actividades:{
        collection:'clienteactividadsitio',
        via:'cas_cliente',
    }
  }
};

