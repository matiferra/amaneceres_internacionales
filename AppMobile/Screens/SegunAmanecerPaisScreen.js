import { StatusBar } from 'expo-status-bar';
import React, {Component} from 'react';
import { StyleSheet, Text, Button,  View } from 'react-native';

export class HomeScreen extends Component {

    constructor(props){
        super(props);
        this.state={
            nombres: [],
            encontrado: true,
            unaVez: false,
        }

        this.handlerobtenerPaises = this.handlerobtenerPaises.bind(this); 
        this.handlerRegistrarArticulo = this.handlerRegistrarArticulo.bind(this); 
        this.handlerMostrarMarca = this.handlerMostrarMarca.bind(this); 
    }

    render(){
        return(
            <View >
                <Text>EDITAR VISTA</Text>

                <Button
                onPress={() => { this.props.navigation.navigate('Continentes') }}
                title="INGRESAR"
                
                color="#990"
            />
            </View>
            );
    }
    
}


const styles = StyleSheet.create({
    container: {
      flex: 1,
      backgroundColor: '#fff',
      alignItems: 'center',
      justifyContent: 'center',
    },
    texto: {
        fontSize: 20
    }
  });