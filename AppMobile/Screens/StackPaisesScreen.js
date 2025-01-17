import React,  { Component } from 'react';
import { Alert } from 'react-native';
import { ScrollView, TouchableOpacity, ImageBackground, StyleSheet, View, Text } from 'react-native';
import Paises from '../libraryPaises';
import Datos from '../libraryDatosUsuario';



export  class StackPaisesScreen extends Component{

    constructor(props){
        super(props);
        this.state={
            param: this.props.route.params,
            paises: [],
            continente: '',
            pais: '',
            capital: '',
            GMT: 0.0,
            latitud: 0,
            longuitud: 0,
            id_usuario: 0,
            cargando: true,
            seteado: false,
            existeUsuario: false,
        }
    
        this.handlerobtenerPaises = this.handlerobtenerPaises.bind(this); 
        this.renderPaises = this.renderPaises.bind(this); 
        this.handlerSetearDatos = this.handlerSetearDatos.bind(this);
        this.sleep = this.sleep.bind(this);
      //  this.handlerSetearPais = this.handlerSetearPais.bind(this); 
    }  

    

      componentWillUnmount() {
        this.setState({
            paises: [],
            cargando: true,
        });
      }
      

      handlerobtenerPaises(){
        Paises.getxContinente(this.state.param.continente).then((paises) => {
            this.setState({
                paises: paises,
                cargando: false,
            });
        }).catch((err) => {
            console.log(err); 
        });
    }

    sleep (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }
      

    handlerSetearDatos(pais){
        Datos.checkear(1).then((usuario) => {
            if(usuario.continente != undefined){
                this.setState({
                    existeUsuario: true,
                })
            }
         }).catch((err) => {
             console.log(err);
             this.setState({
                 existeUsuario: false,
             });
             console.log(this.state.existeUsuario);
         });
         this.sleep(2500).then(() => {
                Paises.getPais(pais.nombre).then((infoPais) => {
                        this.setState({ 
                            continente: infoPais.continente,
                            pais: infoPais.nombre,
                            capital: infoPais.capital,
                            GMT: infoPais.GMT,
                            latitud: infoPais.latitud,
                            longuitud: infoPais.longuitud,
                            });
                    }).then(() => {
                        if(!this.state.existeUsuario){
                            Datos.setear(this.state.continente, this.state.pais, this.state.capital, this.state.GMT, this.state.latitud, this.state.longuitud, true);
                            Alert.alert("Hora Seteada!");
                            /*this.setState({
                                seteado: true,
                            });*/
                        } else {
                            Datos.delete(1).then(() => {Datos.setear(this.state.continente, this.state.pais, this.state.capital, this.state.GMT, this.state.latitud, this.state.longuitud, true);
                                Alert.alert("Reseteado!");
                            });
                        }
                    }).catch((err) => {
                        console.log(err);
                        Alert.alert("ERROR")
                    });
                }); 
        }

    renderPaises() {
        return (
            <ImageBackground
                source={require('../assets/mundo.gif')}
                style={styles.background}
              >
            <ScrollView>
                { this.state.paises.map((pais) => {
            return (
                <View key={Math.random()} style={{ flex: 1, justifyContent: 'center',  alignItems: 'center' }}>
                    <Text key={Math.random()} style={{ flex: 1, fontWeight: 'bold',  fontSize: 20, color: 'white' }}> {pais.nombre} </Text>
                    <Text key={Math.random()} style={{ flex: 1, fontSize: 18, color: 'white' }}> Ciudad - {pais.capital} </Text>
                    <TouchableOpacity 
                    key={Math.random()}
                    onPress={() => this.handlerSetearDatos(pais)}
                    style={styles.button}>
                    <Text key={Math.random()}style={styles.buttonText}>AGREGAR</Text>
                    </TouchableOpacity>
                </View>
                
                );
            })
                }
            </ScrollView> 
            </ImageBackground>
        ); 
    }  



    render(){
        if(this.state.cargando){
            return(
                <Text>CARGANDO {this.handlerobtenerPaises()}</Text>
            );
        }
        else{
            return(
            this.renderPaises()
            );
        }
    }  
}

const styles = StyleSheet.create({
    container: {
      paddingTop: 60,
      alignItems: 'center'
    },
    background: {
        width: '100%',
        height: '100%'
    },
    button: {
      marginBottom: 30,
      width: 260,
      alignItems: 'center',
      backgroundColor: 'rgba(52, 52, 52, 0.6)'
    },
    buttonText: {
      textAlign: 'center',
      padding: 20,
      color: 'white'
    }
  });