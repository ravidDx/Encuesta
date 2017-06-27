/**
 * Respuesta.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    re_respuesta: {
      type: 'string',
    },
    re_tienePregunta:{
        model:'pregunta',
    },
    re_tieneOpcion:{
        model:'opcion'
    },
    re_pertenececas:{
      model:'clienteactividadsitio'
    }
  }
};

