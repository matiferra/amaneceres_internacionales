import API from './API';

const Paises = { //Objeto Movie Service
  getAll: () => new Promise(
    (resolve,reject) => {
      API.get('/paises')
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
  getxContinente: (continente) => new Promise (
    (resolve,reject) => {
      API.get('/paises/continente/nombre/'+ continente)
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
  getPais: (pais) => new Promise (
    (resolve,reject) => {
      API.get('/paises/nombre/'+ pais)
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
  getGTM: (pais) => new Promise (
    (resolve,reject) => {
      API.get('/paises/nombre/'+ pais)
      .then(
        res => res.data.GMT_UTC
      )
      .then(
        data => resolve(data)
      )
      .catch(
        err => reject(err)
      )
    }
  ),
}

export default Paises;