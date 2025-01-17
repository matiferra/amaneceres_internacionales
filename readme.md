# Proyecto: Amaneceres Artificiales / Sol Artificial

## Descripción General

El proyecto consta de las siguientes partes:

1. **API con Rutas Públicas y Privadas**: 
   Desarrollada con Laravel, permite la interacción entre los distintos componentes del sistema.
   
2. **Página Web**:
   Gestiona el alta, baja y modificaciones de ciudades y usuarios.
   
3. **Aplicación Móvil**:
   Desarrollada con Expo, React Native y JavaScript, permite configurar el dispositivo y enviar datos al servidor.
   
4. **Sol Artificial**:
   Implementado en hardware con un NodeMCU ESP 8266 y controlado mediante software escrito en LUA en Arduino IDE.

---

## Tecnologías Utilizadas

- **Back-End**: Laravel (Framework PHP)
- **Front-End**: React Native, Expo y JavaScript
- **Software del Dispositivo**: LUA en Arduino IDE
- **Hardware**:
  - NodeMCU ESP 8266
  - Tira de LED 12v
  - Resistencias (1k ohm y 100 ohm)
  - Transistores IRF 530N
  - Fuente de alimentación 12v
  - Protoboard
  - Conductores macho-macho - macho-hembra

---

## Funcionamiento del Sistema

1. **Consulta de Ubicaciones**:
   - La aplicación móvil realiza una consulta a una ruta pública de la API para obtener continentes, países y ciudades previamente registrados en la base de datos.

2. **Configuración del Usuario**:
   - El usuario selecciona una ciudad desde la aplicación móvil.
   - Los datos de configuración se envían a través de Internet y se almacenan en la base de datos asociada a cada usuario.

3. **Sincronización del Sol Artificial**:
   - El NodeMCU consulta constantemente la hora UTC desde un servidor NTP.
   - Utiliza la configuración del usuario y calcula la hora local de la ciudad seleccionada.
   - Con la latitud y longitud, se consultan los horarios de crepúsculo, salida y puesta del sol a una API pública.

---

## Uso de la API

Toda la información devuelta por los servicios REST está en formato JSON.

### **Endpoints Públicos**

| Método | Endpoint                                    | Descripción                                      |
|--------|---------------------------------------------|--------------------------------------------------|
| GET    | `/api/continentes`                          | Devuelve todos los continentes.                 |
| GET    | `/api/continentes/id/{id}`                  | Devuelve un continente por su ID.               |
| GET    | `/api/países`                               | Devuelve todos los países.                      |
| GET    | `/api/países/nombre/{nombre}`               | Devuelve un país por su nombre.                 |
| GET    | `/api/países/continentes/nombre/{continente}` | Devuelve países por el nombre del continente.   |

### **Endpoints Privados (Administración)**

| Método | Endpoint                                   | Descripción                                      |
|--------|--------------------------------------------|--------------------------------------------------|
| GET    | `/api/admin/usuario/{id}`                 | Devuelve los datos del usuario por su ID.       |
| POST   | `/api/admin/datos-usuario`                | Registra la configuración seleccionada por un usuario. |
| GET    | `/api/admin/datos-usuario/{id}`           | Devuelve la configuración de un usuario por ID. |
| PUT    | `/api/admin/datos-usuario/{id}`           | Actualiza la configuración de un usuario.       |
| DELETE | `/api/admin/usuario/{id}`                 | Elimina un usuario por ID.                      |

---

## Rutas de los CRUDs

| Página           | Descripción                              |
|-------------------|------------------------------------------|
| `/admin/login`    | Página de autenticación.                |
| `/admin/países`   | Gestión de países (CRUD).               |
| `/admin/usuarios` | Gestión de usuarios (CRUD).             |

---

## Requisitos para la Ejecución

1. **Backend**:
   - PHP >= 8.0
   - Laravel Framework
   - Base de datos configurada (MySQL u otra compatible)
   
2. **Frontend**:
   - Expo CLI instalado
   - Node.js >= 14

3. **Hardware**:
   - NodeMCU ESP 8266 configurado con Arduino IDE
   - Conexión a Internet para consultas NTP y API.

---

## Instalación y Configuración

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/matiferra/amaneceres_internacionales.git
