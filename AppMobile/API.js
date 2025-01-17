import axios from 'axios';

const API = axios.create({
    baseURL : "https://www.ferrario-matias.me/api",
  
});

API.defaults.headers.common['Authorization'] = 'Bearer O1eFX8rDufrY1JK0xUMvY7SMbXve9beSdvAX78AT7oQ05HSwKaw1NpcYq729';

export default API; 