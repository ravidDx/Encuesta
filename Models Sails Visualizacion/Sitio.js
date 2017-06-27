/**
 * Sitio.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
    //Datos del Sitio
    
    st_numeroID: {
      type: 'string'
    },
    st_nombreComercial: {
      type: 'string'
    },
    st_callePrincipal:{
      type: 'string'
    },
    st_calleSecundaria:{
      type: 'string'
    },
    st_numeroLote:{
      type: 'string'
    },
    st_razonSocial: {
      type: 'string'
    },
    st_IdVendedor: {
      type: 'string'
    },
    st_nombreVendedor: {
      type: 'string'
    },
    st_codigoRuta: {
      type: 'string'
    },
    st_zonaSupervisor: {
      type: 'string'
    },
    st_zonaRegional: {
      type: 'string'
    },
    st_canal: {
      type: 'string'
    },
    st_zonaNacional: {
      type: 'string'
    },
    st_latitud: {
      type: 'string'
    },
    st_longitud: {
      type: 'string'
    },
    st_estadoSitio: {
      type: 'string'
    },
    st_publica:{
      model:'proveedor'
    },  
    st_actividades:{
        collection:'actividadsitio',
        via:'as_tienesitio',
    }
  }
};

