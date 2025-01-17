import API from './API';

const Continentes = {
  getAll: () => new Promise(
    (resolve,reject) => {
      API.get('/continentes')
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
  getContinente: (continente) => new Promise (
    (resolve,reject) => {
      API.get('/continentes/nombre/'+ continente)
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
  getContinentexID: (continente) => new Promise (
    (resolve,reject) => {
      API.get('/continentes/id/'+ continente)
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
}

export default Continentes;