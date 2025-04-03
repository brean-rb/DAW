import { Empleado } from "./empleado.model"
import { ServicioEmpleadosService } from './servicio-empleados.service'; // Asegúrate de que la ruta sea correcta
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class EmpleadosService {
  // Your service logic here

    empleados:Empleado[]=[
    new Empleado("Juan", "Perez","presidente",7400),
    new Empleado("Marcos", "Gomez","informatico",2300),
    new Empleado("Natalia", "Sanchez","profesora",1850),
    new Empleado("Sara", "tronco","mecanica",2020),

  ];

  constructor(private miServicio: ServicioEmpleadosService) {}


  agregarEmpleadosServicio(empleado:Empleado){
        this.empleados.push(empleado);
  }
}