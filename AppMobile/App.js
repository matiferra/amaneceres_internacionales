import React, {Component} from 'react';
import { StyleSheet} from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import DrawerMenu from './Navigators/DrawerMenu';
import Login from './Screens/Login';

export default class App extends Component {
  
  constructor(props){
    super(props);
    this.state = {
      isLoggedIn:true, 
    }
}

setLogin(){
    this.setState({isLoggedIn:true});
}

setLogout(){
    this.setState({isLoggedIn:false});
}

//
render(){

    if(this.state.isLoggedIn){
        return (
                  <NavigationContainer>
                    <DrawerMenu  onLogout={() => this.setLogout()}/>
                  </NavigationContainer>
        );
    } else {
        return(
           <Login onLogin={() => this.setLogin()}/>
        );
    };

  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});
