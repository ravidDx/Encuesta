/**
 * Actividad.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {      
    ac_nombreActividad: {
      type: 'string'
    },
    ac_descripcionActividad: {
      type: 'string'
    },
    ac_fechaInicio:'DATETIME',
    ac_fechaFin:'DATETIME',
    //Para definir si se ha lanzado la actividad o no
    ac_estadoActividad: {
      type: 'string'
    },
    ac_publica:{
        model:'proveedor'
    },
    ac_preguntas:{
        collection:'pregunta',
        via:'pr_contiene',
    }, 
    ac_sitios:{
        collection:'actividadsitio',
        via:'as_tieneactividad',
    },
    //para asignar el valor de la actividad cuando se haya completado
    ac_paquete: {
      type: 'string'
    },
    //para asignar el valor de la actividad cuando se haya completado
    ac_valorpaquete: {
      type: 'string'
    },
    //para asignar la experiencia 
    ac_experienciapaquete: {
      type: 'string'
    },
    //para saber la comision a ganar.
    ac_comisionpaquete: {
      type: 'string'
    },
    //para permitir el numero de registros permitidos
    ac_registrospermitidos: {
      type: 'string'
    },
  }
};

