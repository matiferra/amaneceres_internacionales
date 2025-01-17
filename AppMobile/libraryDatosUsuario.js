import API from './API';

const token = "";



/*API.interceptors.request.use(
  config => {
    config.headers["Authorization"] = "Bearer token: O1eFX8rDufrY1JK0xUMvY7SMbXve9beSdvAX78AT7oQ05HSwKaw1NpcYq729";
    return config;
  },
  error => {
    Promise.reject(error);
  }
)*/


const Datos = {
  checkear: (id) => new Promise (
    (resolve,reject) => {
      API.get('/admin/datos-usuario/'+ id)
      .then(
        res => res.data
      )
      .then(
        data => resolve(data)
      )
      .catch(
        err => reject(err)
      )
    }
  ), 
  setear: (continente, pais, capital, GMT, latitud, longuitud, solo_amanecer)  => {
      API.post('/admin/datos-usuario', {
        continente: continente,
        pais: pais,
        capital: capital,
        GMT_UTC: GMT,
        latitud: latitud, 
        longuitud: longuitud,
        id_usuario: 1 //CHEQUEAR! COMO CONSIGO EL ID DEL USUARIO!
      }).then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
  delete: (id)  => new Promise (
    (resolve,reject) => {
    API.delete(`/admin/datos-usuario/${id}`)
      .then(
        res => res.data
      )
      .then(
        data => resolve(data)
      )
      .catch(
        err => reject(err)
      )
    }
  ),

  /*update: (continente, pais, capital, GMT, latitud, longuitud, solo_amanecer)  => {
    API.put('admin/datos-usuario/', {
        solo_amanecer: true,
        continente: continente,
        pais: pais,
        capital: capital,
        GMT_UTC: GMT,
        latitud: latitud,
        longuitud: longuitud,
        id_usuario: 2 //CHEQUEAR! COMO CONSIGO EL ID DEL USUARIO!
  }).catch(e => {
      console.log(e);
  });
  },*/
}



export default Datos;