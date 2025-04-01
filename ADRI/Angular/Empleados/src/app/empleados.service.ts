import { Empleado } from "./empleado.model";

export class EmpleadosService{
       
  empleados:Empleado[]=[
    new Empleado("Ruben","Ferrer","Informatico",1800),
    new Empleado("Adrian","Marschal","Tecnico",2200),
    new Empleado("Noe","Gonzalez","Recepcion",1500),
    new Empleado("Roberto","Tudor","Mantenimiento",1200),
  ];


  anadirEmpleado(empleado:Empleado){
    this.empleados.push(empleado);    
  }
}