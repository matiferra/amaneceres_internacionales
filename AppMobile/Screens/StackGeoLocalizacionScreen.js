import React,{ useState  } from 'react';
import {View,Text,StyleSheet, Button,ImageBackground} from 'react-native';
//import * as Location from 'expo-location';

export class StackGeoLocalizacionScreen extends React.Component{
    constructor(props) {
        super(props);
        this.state = { 
            email:"",
            password: "",
            latitude:"",
            longitude:"",
        };

        //this.getLocation = this.getLocation.bind(this);
    }



    /*getLocation = async () => {
        let latitude;
        let longitude;
        try {
          const { granted } = await Location.getForegroundPermissionsAsync();
          if (!granted) return;
          const last = await Location.getLastKnownPositionAsync();
          if (last){
            latitude = last.coords.latitude;
            longitude = last.coords.longitude;
          } 
          else {
            let location = await Location.getCurrentPositionAsync({});
            latitude = location.coords.latitude;
            longitude = location.coords.longitude;
          }
          this.setState({latitude});
          this.setState({longitude})
          console.log(this.state.latitude);
          console.log(this.state.longitude);

        } catch (error) {
          console.log(error);
        }
      };

    onPress={this.getLocation}
    */

    render() {
        return(
            <View style={styles.container}>
                <Text>EN MANTENIMIENTO</Text>
            </View>    
        );
    }


}

const styles = StyleSheet.create({
    container:{
        flex:1,
        padding:35,
        marginTop:100
    },
    inputGroup:{
        flex:1,
        padding:0,
        marginBottom:15,
        borderBottomWidth:1,
        borderBottomColor:'#cccccc'

     },
     titulo:{
         textAlign:'right'
     },
     background:{
        flex: 1
    
     }
})

