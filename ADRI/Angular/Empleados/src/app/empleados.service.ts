import { Empleado } from "./empleado.model"
import { ServicioEmpleadosService } from './servicio-empleados.service'; // Asegúrate de que la ruta sea correcta
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class EmpleadosService {
  // Your service logic here
  constructor(private miServicio: ServicioEmpleadosService) {}


    empleados:Empleado[]=[
    new Empleado("Juan", "Perez","presidente",7400),
    new Empleado("Marcos", "Gomez","informatico",2300),
    new Empleado("Natalia", "Sanchez","profesora",1850),
    new Empleado("Sara", "tronco","mecanica",2020),

  ];



  agregarEmpleadosServicio(empleado:Empleado){
    this.miServicio.muestraMensaje(
      "Nombre: " + empleado.nombre+ "\n" +
      "Apellido: " + empleado.apellido + "\n" +
      "Cargo: " + empleado.cargo+ "\n" +
      "Salario: " + empleado.salario);
    this.empleados.push(empleado);
  }

  encontrarEmpleado(indice:number){
    let empleado:Empleado= this.empleados[indice];
    return empleado;
  }
  actualizarEmpleado(empleado:Empleado,indice:number){
    let empleadoMod = this.empleados[indice];
    empleadoMod.nombre = empleado.nombre;
    empleadoMod.apellido = empleado.apellido;
    empleadoMod.cargo = empleado.cargo;
    empleadoMod.salario = empleado.salario;
  }
  eliminarEmpleado(indice:number){
    this.empleados.splice(indice, 1);
  }
}