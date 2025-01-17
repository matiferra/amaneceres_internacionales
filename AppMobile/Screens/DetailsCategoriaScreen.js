import React, {Component} from 'react';
import { View, Text, Button, TouchableOpacity, StyleSheet, ScrollView, Alert } from 'react-native';
import Articulos from '../libraryPaises';
import obtenerArticulo from '../librarySupermercadoArticulo';
import restarArticulo from '../librarySupermercadoArticulo';
import obtenerxNombreUsuario from '../librarySupermercadoArticulo';
import obtenerMarca from '../librarySupermercadoMarca';
import obtenerCategoria from '../librarySupermercadoCategoria';
import storeArticulo from '../libraryUsuario';



export class DetailsCategoriaScreen extends Component {

    constructor(props){
        super(props);
        this.state={
            articulos: [],
            id: "",
            nombre: "", 
            precio: 0,
            marca: "",
            categoria: "",
            param: this.props.route.params,
            cargando: true,
        }
        this.handlerobtenerArticulos = this.handlerobtenerArticulos.bind(this); 
        this.handlerRegistrarArticulo = this.handlerRegistrarArticulo.bind(this); 
        this.handlerMostrarMarca = this.handlerMostrarMarca.bind(this); 
    
    }

      componentWillUnmount() {
        this.setState({
            articulos: [],
            cargando: true,
        });
      }
 

      handlerMostrarMarca(articulo){
        obtenerMarca(articulo).then((infoMarca) => {
            return infoMarca.data.nombre;
        });
    }
     
    handlerRegistrarArticulo(articulo){     
        obtenerArticulo(articulo).then((infoArticulo) => {
            this.setState({ 
                nombre: infoArticulo.data.nombre,
                precio: infoArticulo.data.precio,
                });
            Alert.alert("Cargando.");
            return infoArticulo;
            }).then((infoArticulo) =>  {
                obtenerMarca(infoArticulo.data.id_marca).then((infoMarca) => {
                    this.setState({  
                        marca : infoMarca.data.nombre,
                    });
                Alert.alert("Cargando..");
                return infoMarca; 
                }).then((infoMarca) => {
                    obtenerCategoria(infoMarca.data.id_categoria).then((infoCategoria) => {
                        this.setState({  
                        categoria : infoCategoria.data.nombre
                        });
                        Alert.alert("Cargando...");
                        storeArticulo(this.state.nombre, this.state.precio, this.state.marca, this.state.categoria).then(() => {
                            Alert.alert("Articulo Cargado con Exito!"); });
                    });
                    
                });
        }).catch((err) => {
            console.log(err);
            this.setState({      
                encontrado: false,
            }); 
        });
    }

    handlerobtenerArticulos(){
        Articulos.getAll(this.state.param.categoria).then((articulos) => {
            this.setState({
                articulos: articulos,
                cargando: false,
            });
        }).catch((err) => {
            this.setState({
                cargando: false,
            });
        }).catch((err) => {
            console.log(err); 
        });
    }


    renderArticulos() {
        
        return (
            <ScrollView>
                { this.state.articulos.map((articulo) => {
            return (
                <View key={Math.random()} style={{ flex: 1, justifyContent: 'center',  alignItems: 'center' }}>
                    <Text key={Math.random()}> {articulo[0].nombre} </Text>
                    <Text>{this.handlerMostrarMarca(articulo[0].id_marca)}</Text>
                    <Text key={Math.random()}> Precio: {articulo[0].precio} </Text>
                    <TouchableOpacity 
                    key={Math.random()}
                    onPress={() => this.handlerRegistrarArticulo(articulo[0].id)}
                    style={styles.button}>
                    <Text key={Math.random()}style={styles.buttonText}>AGREGAR</Text>
                    </TouchableOpacity>
                </View>
                );
            })
                }
            </ScrollView> 
        ); 
    } 

    render() {
        if(this.state.cargando){
            return(
                <View>
                <   Text> CARGANDO {this.handlerobtenerArticulos()} </Text>
                </View>
            );
        } else{
            return(
                this.renderArticulos()
            );
        }
    }

        
    
}
const styles = StyleSheet.create({
    container: {
      paddingTop: 60,
      alignItems: 'center'
    },
    button: {
      marginBottom: 30,
      width: 260,
      alignItems: 'center',
      backgroundColor: '#2196F3'
    },
    buttonText: {
      textAlign: 'center',
      padding: 20,
      color: 'white'
    }
  });