/**
 * ActividadSitio.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
  	//Foreign Key sitio
  	as_tienesitio:{
        model:'sitio'
    },
    //Foreign Key actividad
    as_tieneactividad:{
        model:'actividad'
    },
    //Clientes que respondieron la actividad en el sitio
    as_clientes:{
    	collection:'clienteactividadsitio',
        via:'cas_actividadsitio',
    },
    //actividad activa o inactiva en caso que se haya llenado el limite establecido por x usuarios
    as_estadoActividad: {
      type: 'string'
    },
  }
};

