import * as React from 'react';
import { Text,TextInput,View, Image,ImageBackground, StyleSheet } from 'react-native';
import { Icon,Button } from 'react-native-elements'

const imgbg = require('../assets/fondoLogin.png');

export default class Login extends React.Component {
  
    constructor(props){
        super(props);
    }

    //https://medium.com/reactbrasil/consumindo-api-rest-com-autentica%C3%A7%C3%A3o-jwt-no-react-native-eec62b852ff3
   
    async saveUser(user) {
        await AsyncStorage.setItem('@ListApp:userToken', JSON.stringify(user))
    }
    
    async signIn() {
    if (username.length === 0) return

    setLoading(true)
        try {
            const credentials = {
            email: username,
            password: password
            }

            const response = await api.post('/sessions', credentials)

            const user = response.data

            await saveUser(user)

            const resetAction = StackActions.reset({
            index: 0,
            actions: [NavigationActions.navigate({ routeName: 'App' })],
            })

            setLoading(false)

            props.navigation.dispatch(resetAction)
        } catch (err) {
            console.log(err)

            setLoading(false)
            setErrorMessage('Usuário não existe')
        }
    }



  render() {
    return (
        <ImageBackground source={imgbg} style={{width: '100%', height: '100%'}}>
             <View>
              <Text style={styles.title}>asdasd</Text>
             </View>

          <View style={styles.container}>
            <View style={styles.containerUserName}>
              <Icon type="font-awesome" name="user" color="gray" containerStyle={styles.icon}/>
              <TextInput placeholder="Usuario" placeholderTextColor="gray"
              style={styles.textInput}/> 
            </View>

            <View style={styles.containerPassword}>
              <Icon type="entypo" name="key" color="gray" containerStyle={styles.icon}/>
              <TextInput placeholder="Contraseña" placeholderTextColor="gray"
              style={styles.textInput} secureTextEntry={true}/> 
            </View>

            <View style={styles.containerSignIn}>
              <Button 
              title='INGRESAR'
              backgroundColor='#ffa100'
              onPress={() => this._signInWithGoogle()}
              />
            </View>
            
            
          </View>        
        </ImageBackground>
    );
  }
}

const styles = StyleSheet.create({
  container:{
    flex:1,
    flexDirection: 'column',
    justifyContent:'center',
    alignItems: 'stretch',
  },
  title:{
    marginLeft:'40%',
    marginRight:'6%',
    paddingTop:'0%',
    color:'white',
    fontWeight: 'bold',
    fontSize: 18,
  },

  containerSignIn:{
    height: 60,
    marginLeft:'6%',
    marginRight:'6%',
    paddingTop:'2%'
  },
  containerUserName:{
    height: 60,
    flexDirection:'row',
    justifyContent:'center',
    backgroundColor:'#ffffff',
    marginLeft:'10%',
    marginRight:'10%',
  },
  containerPassword:{
    margin: 3,
    height: 60,
    flexDirection:'row',
    justifyContent:'center',
    backgroundColor:'#ffffff',
    marginLeft:'10%',
    marginRight:'10%',
  },
  icon:{
    flex:1
  },
  textInput:{
    backgroundColor:'transparent',
    flex:5,
    color:'black',
    paddingLeft:'25%'
  }
})