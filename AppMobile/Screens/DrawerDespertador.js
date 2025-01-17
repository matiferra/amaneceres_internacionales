import React, {Component}  from 'react';
import { Button, Text, View, StyleSheet } from "react-native";
//import DateTimePickerModal from "react-native-modal-datetime-picker";
export class DrawerDespertador extends Component {
  
  render() {
/*

    const showDatePicker = () => {
      setDatePickerVisibility(true); 
    };
  
    const hideDatePicker = () => {
      setDatePickerVisibility(false);
    };
  
    const handleConfirm = (date) => {
      console.warn("A date has been picked: ", date);
      hideDatePicker();
    };
    
    
    en metodo return 
    <Button title="Show Date Picker" onPress={showDatePicker} />
      <DateTimePickerModal
        isVisible={true}
        mode="date"
        onConfirm={handleConfirm}
        onCancel={hideDatePicker}
      />
    
    
    */
    return (
      <View style={styles.container}>
        <Text>EN MANTENIMIENTO</Text>
      </View>
    );
  }
}
const styles = StyleSheet.create({
  container: {
    flex:1,
    flexDirection: 'column',
    justifyContent:'center',
    alignItems: 'center',
    marginBottom: 60
  },
});




