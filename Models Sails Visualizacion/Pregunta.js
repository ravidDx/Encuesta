/**
 * Pregunta.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    pr_idpregunta: {
      type: 'string',
    },
    pr_pregunta: {
      type: 'string',
    },
    pr_tipoPregunta: {
      type: 'string',
    },
    pr_required: {
      type: 'boolean',
    },
    pr_visible: {
      type: 'boolean',
    },
    pr_orden: {
      type: 'string',
    },
    pr_contiene:{
        model:'actividad'
    },
    pr_participacion:{
      type: 'float',
    },
    pr_respuestas:{
        collection:'respuesta',
        via:'re_tienePregunta',
    },
    pr_opciones:{
        collection:'opcion',
        via:'op_pertenece',
    },
    pr_trigger:{
      collection:'opcion',
      via:'op_trigger',
    },
  }
};

