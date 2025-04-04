import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ServicioEmpleadosService } from '../servicio-empleados.service';
import { EmpleadosService } from '../empleados.service';
import { Empleado } from '../empleado.model';
@Component({
  selector: 'app-proyectos-component',
  templateUrl: './proyectos-component.component.html',
  styleUrls: ['./proyectos-component.component.css']
})
export class ProyectosComponentComponent implements OnInit {
  
  constructor(private router:Router,private miServicio:ServicioEmpleadosService, private empleadosService:EmpleadosService){}
  
  ngOnInit() {
    this.empleados = this.empleadosService.empleados;

  }

  volverHome(){

    this.router.navigate(['']);
  }


    empleados:Empleado[]= [];
    cuadroNombre:string = "";
    cuadroApellido:string = "";
    cuadroCargo:string = "";
    cuadroSalario:number = 0;
  
  
    agregarEmpleado(){
      let miEmpleado = new Empleado(this.cuadroNombre,this.cuadroApellido,this.cuadroCargo,this.cuadroSalario);
      
      //   this.miServicio.muestraMensaje(
      //   "Nombre: " + miEmpleado.nombre+ "\n" +
      //   "Apellido: " + this.cuadroApellido + "\n" +
      //   "Cargo: " + this.cuadroCargo + "\n" +
      //   "Salario: " + this.cuadroSalario
      // );
      this.empleadosService.agregarEmpleadosServicio(miEmpleado);
      this.router.navigate(['']);

    }
}
