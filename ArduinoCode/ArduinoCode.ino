#include <NTPClient.h> //importamos la librería del cliente NTP
#include <ESP8266WiFi.h> //librería necesaria para la conexión wifi
#include <WiFiUdp.h> // importamos librería UDP para comunicar con NTP
#include <ArduinoJson.h>

#include <ESP8266HTTPClient.h>

#define LUZ 4
                     
//Datos de la red a la que se conectara
String ssid     = "IPLANLiv-Cervetti-2.4Ghz"; 
String password = "13112019";


//bool begin(WiFiClient &client, String host, uint16_t port, String uri, bool https);

String apiNostra = "http://ferrario-matias.me/api/admin/datos-usuario/1";

//iniciamos el cliente udp para su uso con el server NTP
WiFiUDP ntpUDP;
  
//Defino una variable de Cliente
WiFiClient client;

//Creamos una objeto del tipo NTP llamada timeCliente() con sus contructor
//Pasamos parametros cliente UDP y servidor de hora del pais
NTPClient timeClient(ntpUDP, "0.pool.ntp.org");


/*void processResponse(int httpCode, HTTPClient& http)
{
   if (httpCode > 0) {
      Serial.printf("Response code: %d\n", httpCode);
      if (httpCode == HTTP_CODE_OK) {
         String payload = http.getString();
         //Serial.println(payload);
      }
   }
   else {
      Serial.printf("Request failed, error: %s\n", http.errorToString(httpCode).c_str());
   }
   http.end();
}*/



void checkearSetear(String horaMeridiano)
{
   String meridiano_hs_String;
   String meridiano_min_String;
   String meridiano_seg_String;
   meridiano_hs_String.concat(horaMeridiano[0]);
   meridiano_hs_String.concat(horaMeridiano[1]);
   meridiano_min_String.concat(horaMeridiano[3]);
   meridiano_min_String.concat(horaMeridiano[4]);
   meridiano_seg_String.concat(horaMeridiano[6]);
   meridiano_seg_String.concat(horaMeridiano[7]);
   int meridiano_hora = meridiano_hs_String.toInt();
   int meridiano_minutos = meridiano_min_String.toInt();
   int meridiano_segundos = meridiano_seg_String.toInt();
   
   DynamicJsonDocument doc(3072);
   HTTPClient http;
   
   http.setAuthorization("");
   http.begin(client, apiNostra);
   http.addHeader("Authorization","Bearer SmSriCDVifCTs5wCa5VIbHbCinKYHo3jNirppqQhusWFuWog14LWCrBwd6fv");
   http.addHeader("Content-Type", "application/json");
   int httpCode = http.GET(); 
   DeserializationError error = deserializeJson(doc, http.getString());
   if (error) {
      Serial.print(F("deserializeJson() failed: "));
      Serial.println(error.f_str());
   }
   //String continente = doc["continente"];
   String pais = doc["pais"];
   String capital = doc["capital"];
   String UTC_string = doc["GMT_UTC"];
   String latitud = doc["latitud"];
   String longitud = doc["longuitud"];

   String UTC_hs_String;
   String UTC_min_String;
   String UTC_seg_String;
   UTC_hs_String.concat(UTC_string[0]);
   if(UTC_hs_String.equals("-")){
     UTC_hs_String.concat(UTC_string[1]);
     UTC_hs_String.concat(UTC_string[2]);
     UTC_min_String.concat(UTC_string[4]);
     UTC_min_String.concat(UTC_string[5]);
     UTC_seg_String.concat(UTC_string[7]);
     UTC_seg_String.concat(UTC_string[8]);
   } else{
     UTC_hs_String.concat(UTC_string[1]);
     UTC_min_String.concat(UTC_string[3]);
     UTC_min_String.concat(UTC_string[4]);
     UTC_seg_String.concat(UTC_string[6]);
     UTC_seg_String.concat(UTC_string[7]);
   }
   int UTC_horas = UTC_hs_String.toInt();
   int UTC_minutos = UTC_min_String.toInt();
   int UTC_segundos = meridiano_segundos;
   
   String hostApiSun = "http://api.sunrise-sunset.org/json?lat=" + latitud + "&lng=" + longitud;
   http.begin(client, hostApiSun);
   httpCode = http.GET(); 
   error = deserializeJson(doc, http.getString());
   String sunrise = doc["results"]["nautical_twilight_begin"];
   String sunset = doc["results"]["nautical_twilight_end"];
   String dayLength = doc["results"]["day_length"];

//ORDENAAAAAAAAAAAAAAR
   String day_hs_String; 
   String day_min_String;   
   day_hs_String.concat(dayLength[0]);
   day_hs_String.concat(dayLength[1]);
   day_min_String.concat(dayLength[3]);
   day_min_String.concat(dayLength[4]);

   int horas_dia = day_hs_String.toInt();
   int min_dia = day_min_String.toInt();
   
   
   String sunrise_hs_String;
   String sunrise_min_String;
   String sunrise_seg_String;
   String sunrise_checkeo_String;
   String sunrise_hs_String_AM_PM;
   sunrise_checkeo_String.concat(sunrise[1]);
   sunrise_hs_String.concat(sunrise[0]);
   if(sunrise_checkeo_String.equals(":")){
     sunrise_hs_String_AM_PM.concat(sunrise[8]);
     sunrise_min_String.concat(sunrise[2]);
     sunrise_min_String.concat(sunrise[3]);
     sunrise_seg_String.concat(sunrise[5]);
     sunrise_seg_String.concat(sunrise[6]);
   } else {
     sunrise_hs_String_AM_PM.concat(sunrise[9]);
     sunrise_hs_String.concat(sunrise[1]);
     sunrise_min_String.concat(sunrise[3]);
     sunrise_min_String.concat(sunrise[4]);
     sunrise_seg_String.concat(sunrise[6]);
     sunrise_seg_String.concat(sunrise[7]);
   }

   int sunrise_hora = sunrise_hs_String.toInt();
   if(sunrise_hs_String_AM_PM.equals("P")){
      sunrise_hora = sunrise_hora + 12;
   } 
   int sunrise_minutos = sunrise_min_String.toInt();
   int sunrise_segundos = sunrise_seg_String.toInt();

   String sunset_hs_String;
   String sunset_min_String;
   String sunset_seg_String;
   String sunset_checkeo_String;
   String sunset_checkeo_AM_PM;
   sunset_checkeo_String.concat(sunset[1]);
   sunset_hs_String.concat(sunset[0]);
   if(sunset_checkeo_String.equals(":")){
     sunset_checkeo_AM_PM.concat(sunset[8]);
     sunset_min_String.concat(sunset[2]);
     sunset_min_String.concat(sunset[3]);
     sunset_seg_String.concat(sunset[5]);
     sunset_seg_String.concat(sunset[6]);
   } else {
     sunset_checkeo_AM_PM.concat(sunset[9]);
     sunset_hs_String.concat(sunset[1]);
     sunset_min_String.concat(sunset[3]);
     sunset_min_String.concat(sunset[4]);
     sunset_seg_String.concat(sunset[6]);
     sunset_seg_String.concat(sunset[7]);
   }
   int sunset_hora = sunset_hs_String.toInt();

   int sunset_minutos = sunset_min_String.toInt();
   int sunset_segundos = sunset_seg_String.toInt();
   if(sunset_checkeo_AM_PM.equals("P")){
      sunset_hora = sunset_hora + 12;
   } 
   

   //VARIABLE A CALCULAR
   String horaActual;
   int hora = meridiano_hora + UTC_horas;
   if(hora > 23){
    hora = hora - 24;
   }
   if(hora < 0){
    hora = hora + 24;
   }
   int minutos;
   String amanecer;
   int amanecer_hora = sunrise_hora + UTC_horas;
   
   if(amanecer_hora > 23){
    amanecer_hora = amanecer_hora - 24;
   }
   if(amanecer_hora < 0){
    amanecer_hora = amanecer_hora + 24;
   }
   int amanecer_min;
   int amanecer_seg = sunrise_segundos;
   String atardecer;
   int atardecer_hora = sunset_hora + UTC_horas;
   if(atardecer_hora > 23){
    atardecer_hora = atardecer_hora - 24;
   }
   if(atardecer_hora < 0){
    atardecer_hora = atardecer_hora + 24;
   }
   int atardecer_min;
   int atardecer_seg = sunset_segundos;

   if(UTC_horas < 0){
   minutos = meridiano_minutos - UTC_minutos;
   atardecer_min = sunset_minutos - UTC_minutos;
   amanecer_min = sunrise_minutos - UTC_minutos;
    if(minutos < 0){
      minutos = minutos + 60;
      hora = hora - 1;
    }
    if(amanecer_min < 0){
      amanecer_min = amanecer_min + 60;
      amanecer_hora = amanecer_hora - 1;
    }   
    if(atardecer_min < 0){
      atardecer_min = atardecer_min + 60;
      atardecer_hora = atardecer_hora - 1;
    }
    
   }else {
   minutos = meridiano_minutos + UTC_minutos;
   atardecer_min = sunset_minutos + UTC_minutos;
   amanecer_min = sunrise_minutos + UTC_minutos;
   if(minutos > 60){
      minutos = minutos - 60;
      hora = hora + 1;
    }
    if(atardecer_min > 60){
      atardecer_min = atardecer_min - 60;
      atardecer_hora = atardecer_hora + 1;
    }
    if(amanecer_min > 60){
      amanecer_min = amanecer_min - 60;
      amanecer_hora = amanecer_hora + 1;
    }
   }
   
   horaActual.concat(hora);
   horaActual.concat(":");
   horaActual.concat(minutos);
   horaActual.concat(":");
   horaActual.concat(meridiano_segundos);

   amanecer.concat(amanecer_hora);
   amanecer.concat(":");
   amanecer.concat(amanecer_min);
   amanecer.concat(":");
   amanecer.concat(amanecer_seg);

   atardecer.concat(atardecer_hora);
   atardecer.concat(":");
   atardecer.concat(atardecer_min);
   atardecer.concat(":");
   atardecer.concat(atardecer_seg);

   
   Serial.println("---HORA MEDIDIANO---");
   Serial.println(horaMeridiano);
  /* Serial.println(meridiano_hora);
   Serial.println(meridiano_minutos);
   Serial.println(meridiano_segundos);
   */
   Serial.println("------LUGAR--------");
   Serial.println(pais);
   Serial.println(capital);
   Serial.println("Hora Actual");
   Serial.println(horaActual);
   /*Serial.println("Amanecer");
   Serial.println(amanecer);
   Serial.println("Atardecer");
   Serial.println(atardecer);
   Serial.println("------UTC--------");
   Serial.println(UTC_string);
   Serial.println(UTC_horas);
   Serial.println(UTC_minutos);
   Serial.println(UTC_segundos);
   */Serial.println("------SUNRISE--------");
   Serial.println(sunrise);
   /*Serial.println(sunrise_hora);
   Serial.println(sunrise_minutos);
   Serial.println(sunrise_segundos);
   */Serial.println("------SUNSET--------");
   Serial.println(sunset);
   /*Serial.println(sunset_hora);
   Serial.println(sunset_minutos);
   Serial.println(sunset_segundos);
   */Serial.println("");
   
   
   //processResponse(httpCode, http);

  
  //------------  ACTIVAR LUCES ------------ //
  //1 min = 60000 / 1023     = 58
  //30min = 1800000 / 1023   = 1759

   // VARIABLES DURANTE EL DIA
   String hora_amanecer_String;
   
   hora_amanecer_String.concat(amanecer_hora*60*60);
   int hora_amanecer_SEG = hora_amanecer_String.toInt();
   hora_amanecer_SEG = hora_amanecer_SEG+ amanecer_min *60 + amanecer_seg;    
   Serial.println("Amanecer Segundos");
   Serial.println(hora_amanecer_SEG);
   
   String hora_atardecer_String;
   
   hora_atardecer_String.concat(atardecer_hora*60*60);
   int hora_atardecer_SEG = hora_atardecer_String.toInt();
   hora_atardecer_SEG = (hora_atardecer_SEG + 3600) + atardecer_min * 60  + atardecer_seg - 600;
   
   String horaActual_String;

   horaActual_String.concat(hora*60*60);
   int horaActual_SEG = horaActual_String.toInt();
   horaActual_SEG = horaActual_SEG + minutos * 60 + UTC_segundos;
   Serial.println("Hora Actual Segundos");
   Serial.println(horaActual_SEG);
   
   /*Serial.println("Hora Actual MIN");
   Serial.println(horaActual_MIN);
   Serial.println("Amanecer MIN");
   Serial.println(hora_amanecer_MIN);
   Serial.println("Atardecer MIN");
   Serial.println(hora_atardecer_String);
   */
   //LOGICA SETEO DURANTE AMANCER
   //Serial.println("Amanecer");
   int i;
   int porcentaje;
   String porcentaje_String;
   int diferenciaParaAmanecer;
   int diferenciaParaAtardecer;
   
   if(horaActual_SEG >= hora_amanecer_SEG && horaActual_SEG < hora_atardecer_SEG){
    Serial.println("Es de DIA"); 
    //LOGICA SETEO DURANTE AMANECER
    diferenciaParaAmanecer = horaActual_SEG - hora_amanecer_SEG;
    diferenciaParaAtardecer = hora_atardecer_SEG - horaActual_SEG;
    if(diferenciaParaAmanecer < 5400){
      i = (diferenciaParaAmanecer * 1023) / 5400;
      porcentaje = (i * 100) / 1023;
      porcentaje_String.concat(porcentaje);
      porcentaje_String.concat("%");
      Serial.println("Esta Amaneciendo");
      //Serial.println("DIFERENCIA");
      //Serial.println(diferenciaParaAmanecer);
      Serial.println("Intensidad de la luz ");
      Serial.println(porcentaje_String);
      analogWrite(LUZ, i); 

      //delay(1759);
    } else if(diferenciaParaAtardecer < 5400){
          Serial.println("Esta Atardeciendo");    
          //Serial.println("DIFERENCIA");
          //Serial.println(diferenciaParaAtardecer);
          Serial.println("Intensidad de la luz ");
          //diferenciaParaAtardecer = diferenciaParaAtardecer * 60;
          i = (diferenciaParaAtardecer * 1023) / 5400;
          porcentaje = (i * 100) / 1023;
          porcentaje_String.concat(porcentaje);
          porcentaje_String.concat("%");
          Serial.println(porcentaje_String);
          analogWrite(LUZ, i);
         // delay(1759);
    } else {
      digitalWrite(LUZ, HIGH);
    } 
  } else {
      Serial.println("Es de NOCHE");
      digitalWrite(LUZ, LOW);
  } 
}
 
void setup() {

  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(LUZ, OUTPUT);


  //Comenzar apagados
  digitalWrite(LUZ, LOW);

  
  //Configuro la IP del NODEMCU como estática y le asigno una IP específica
  IPAddress local_IP(192, 168, 4, 250);
  IPAddress gateway(192, 168, 4, 1);
  IPAddress subnet(255, 255, 255, 0);

  //Seteo a la placa como estación
  WiFi.mode(WIFI_STA);
  
  // Inicio el puerto serial y le seteo 115200 baudios
  Serial.begin(115200);

  // Inicio la Conexión WIFI
  WiFi.begin(ssid, password);
 
  
  while (WiFi.status() != WL_CONNECTED ) { 
    digitalWrite(LED_BUILTIN, HIGH);
    delay(500);
    digitalWrite(LED_BUILTIN, LOW);
  }
  if(WiFi.status() == WL_CONNECTED){
    digitalWrite(2, 1);
  }

  //Inicio el servidor creado previamente en el puerto 80
  //server.begin();
}


void loop() {
    timeClient.begin(); 
    timeClient.update();
    //Serial.println(timeClient.getFormattedTime());
    
    checkearSetear(timeClient.getFormattedTime());
    delay(1500);
}
  
                         

  
