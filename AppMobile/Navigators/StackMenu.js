import React, {Component} from 'react';
import { View, Text } from 'react-native';
import { createStackNavigator } from '@react-navigation/stack';

// Screens
import {HomeScreen} from "../Screens/StackHomeScreen";
import {StackContinentesScreen} from "../Screens/StackContinentesScreen";
import {StackPaisesScreen} from "../Screens/StackPaisesScreen";
import {StackGeoLocalizacionScreen} from "../Screens/StackGeoLocalizacionScreen";

const Stack = createStackNavigator();

export class StackMenu extends Component {
  
  constructor(props){
    super(props);
    this.state={
        nombres: [],
        mail: "hola",
        encontrado: true,
        unaVez: false,
    }
  }

  
  render(){
    return (
          <Stack.Navigator initialRouteName="HomeScreen"
          screenOptions={{
            headerStyle: {
              backgroundColor: '#7caaff',
            },
            headerTintColor: '#fff',
            headerTitleStyle: {
                fontWeight: '600',
                textAlign: 'center',
            }
                       
       }}  
          > 
            <Stack.Screen name="Opciones de Configuracion" component={HomeScreen}/>
            <Stack.Screen name="GeoLocacion" component={StackGeoLocalizacionScreen}/>
            <Stack.Screen name="ElegirCiudad" component={StackContinentesScreen}/>
            <Stack.Screen name="Paises" component={StackPaisesScreen} />

            
          </Stack.Navigator>
    ); 
  }
}