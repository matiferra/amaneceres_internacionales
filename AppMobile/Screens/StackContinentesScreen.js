import { StatusBar } from 'expo-status-bar';
import React, {Component} from 'react';
import { StyleSheet, Text, ImageBackground,  View, ScrollView, Alert, TouchableOpacity } from 'react-native';
import Continentes from "../libraryContinentes";

export class StackContinentesScreen extends Component {

    constructor(props){
        super(props); 
        this.state={
            continentes: [],
            cargando: true,
        }

        this.handlerobtenerContinentes = this.handlerobtenerContinentes.bind(this); 
        this.renderContinetes = this.renderContinetes.bind(this);
    }

    componentWillUnmount() {
        this.setState({
            continentes: [],
            cargando: true,
        });
      }

      handlerobtenerContinentes(){
        Continentes.getAll().then((continentes) => {
            this.setState({
                continentes: continentes,
                cargando: false
            });
        }).catch((err) => {
            console.log(err);
            Alert.alert("ERROR"); 
        });
      }

      renderContinetes() {
        return (
            <ImageBackground
                source={require('../assets/fondoContinentes.jpg')}
                style={styles.background}
              >
            <ScrollView>
                { this.state.continentes.map((continente) => {
            return (
                <View key={Math.random()}style={styles.container}>
                    <TouchableOpacity 
                        key={Math.random()}
                        onPress={() => { this.props.navigation.navigate('Paises', {continente: continente.nombre} ); }}
                        style={styles.button}
                        color="#4A88E1">
                        <Text key={Math.random()}style={styles.buttonText}>{continente.nombre}</Text>
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
                <Text> CARGANDO {this.handlerobtenerContinentes()} </Text>
            );
        } else{
            return(
                this.renderContinetes()
            );
        }
    }
    
}


const styles = StyleSheet.create({
  container: {
    paddingTop: 5,
    alignItems: 'center',
  },
    background: {
        width: '100%',
        height: '100%'
    },
    button: {
        margin: 7,
        width: 260,
        alignItems: 'center',
        backgroundColor: 'rgba(52, 52, 52, 0.6)'
    },
    buttonText: {
        textAlign: 'center',
        padding: 20,
        color: '#cfdfff',
        fontWeight: 'bold',
        fontSize: 15,
    }
});
