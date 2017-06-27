/**
 * Opcion.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
  	op_opcion: {
      type: 'string',
    },
    op_participacion:{
    	type: 'float',
    },
  	op_pertenece:{
        model:'pregunta'
    },
    op_trigger:{
        model: 'pregunta',
        unique: true
    },
    op_respuestas:{
        collection:'respuesta',
        via:'re_tieneOpcion',
    },
  }
};

