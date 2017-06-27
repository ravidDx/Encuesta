/**
 * ClienteActividadSitio.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
  	//Foreign Key cliente
    cas_cliente:{
    	model:'cliente'
    },
    //Foreign Key ActividadSitio
    cas_actividadsitio:{
    	model:'actividadsitio'
    },
    cas_fechaCreacion:'DATETIME',
    cas_fechaModificacion:'DATETIME',
    //Para cuando el proveedor actualiza el registro, el usuario manda "solicitado" y el proveedor aprueba "aprobado".
    cas_statusRegistro:{
      type:'string'
    },
    cas_respuestas:{
        collection:'respuesta',
        via:'re_pertenececas',
    },
    cas_calificacionActividad: {
      type: 'string'
    }
  }
};

