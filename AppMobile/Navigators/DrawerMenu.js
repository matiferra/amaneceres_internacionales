
import React, {Component} from "react";
import { createDrawerNavigator } from '@react-navigation/drawer';

// Screens
import {DrawerContentScreen} from "../Screens/DrawerContentScreen";
import {StackMenu} from "./StackMenu"; 
import {DrawerDespertador} from "../Screens/DrawerDespertador";

const Drawer = createDrawerNavigator();

export default class DrawerMenu extends Component {

    render(){
        return(
            <Drawer.Navigator 
                initialRouteName="StackMenu"
                headerMode={'none'}
                drawerContent={props => <DrawerContentScreen {...props}/>}
            > 
            <Drawer.Screen name="¡ Bienvenido a Sol Artificial !" component={StackMenu} />
            <Drawer.Screen name="Despertador" component={DrawerDespertador} />
            </Drawer.Navigator> 
        );
    }
    
}

