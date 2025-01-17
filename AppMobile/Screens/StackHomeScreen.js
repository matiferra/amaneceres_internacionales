import React,  { Component } from 'react';
import { StyleSheet, Text, View, ImageBackground, Button, ScrollView,  TouchableOpacity  } from 'react-native';


 export class HomeScreen extends Component {

    constructor(props){
        super(props);
    }

    // PONER UN FONDO LOCO Y UN POCO TE TEXTO(TITULO)
    
    render() { 
        return (
          <ImageBackground
          source={require('../assets/fondoLogin.png')}
          style={styles.background}
        >

          <View style={styles.container}>
              <TouchableOpacity 
                  key={Math.random()}
                  onPress={() => { this.props.navigation.navigate('ElegirCiudad') }}
                  style={styles.button}>
                  <Text key={Math.random()}style={styles.buttonText}>ELEGIR ALGUNA CIUDAD DEL MUNDO</Text>
              </TouchableOpacity>
              <TouchableOpacity 
                  key={Math.random()}
                  onPress={() => { this.props.navigation.navigate('GeoLocacion') }}
                  style={styles.button}
                  >
                  <Text key={Math.random()}style={styles.buttonText}>AMANECER EN DONDE ESTOY</Text>
              </TouchableOpacity>
          </View>
          </ImageBackground>
        );
      }
 }

 
const styles = StyleSheet.create({
  container: {
    flex:1,
    flexDirection: 'column',
    justifyContent:'center',
    alignItems: 'stretch',
    marginBottom: 60
  },
  containerButton: {
    margin: 10,
    height: 60,
    flexDirection:'row',
    justifyContent:'center',
    marginLeft:'10%',
    marginRight:'10%',
  },
  background: {
    width: '100%',
    height: '100%'
  },
  button: {
    marginLeft:'14%',
    marginRight:'6%',
    margin: 10,
    width: 260,
    alignItems: 'center',
    backgroundColor: 'rgba(52, 52, 52, 0.3)'
  },
  buttonText: {
    textAlign: 'center',
    padding: 20,
    color: 'white',
    fontWeight: 'bold',
    fontSize: 18,
  }
});