
// SCREEN PARA REGISTRARSE CON GOOGLE

import React, {Component} from 'react';
import {StyleSheet, Text, View, Button, ImageBackground} from 'react-native';

import * as Google from 'expo-google-app-auth'

export default class LoginScreen extends Component{

    constructor(props){
        super(props);
    }
    // Acuerdense de poner su key de Google Console
    async _signInWithGoogle(){

        try {
            const result = await Google.logInAsync({
                androidClientId: "109505222123-qemelrull24ac0sq7dpkkh4p1tb6lt69.apps.googleusercontent.com",
                scopes: ['profile', 'email'],
            });
            console.log(result.user[0].email);
            if (result.type === 'success') {
                try {
                    this.props.onLogin();
                    console.log(result[0].mail)
                } catch (error){
                    console.log("Something happened " + error);
                }
            } else {
                return { cancelled: true };
            }

        } catch (e) {
            return { error: true };
        }

    }

    render(){
        return ( 
            <ImageBackground
            source={require('../assets/lala.jpg')}
            style={styles.background}
          >
                <View style={{ marginVertical: 30, flex: 1, justifyContent: 'flex-end',  alignItems: 'stretch' }}>
                    <Text style={styles.texto}> Bienvenido </Text>
                    <Button
                        onPress={() => this._signInWithGoogle()}
                        title="Iniciar sesión con Google"
                    />
                </View>
            </ImageBackground>
        );
    }

}

const styles = StyleSheet.create({
    background: {
        width: '100%',
        height: '100%'
      },

    texto: {
        fontSize: 20,
      }
});

