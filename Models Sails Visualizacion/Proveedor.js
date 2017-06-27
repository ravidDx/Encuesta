/**
 * Proveedor.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    pr_numeroID: {
      type: 'string',
    },
    pr_nombre: {
      type: 'string',
    },
    pr_correo: {
      type: 'string',
    },
    pr_password: {
      type: 'string',
    },
    pr_actividades:{
        collection:'actividad',
        via:'ac_publica',
      }
    },
    pr_sitios:{
        collection:'sitio',
        via:'st_publica',
    }
    
};

