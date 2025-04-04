import { Component, OnInit } from '@angular/core';
import { Empleado } from '../empleado.model';
import { ServicioEmpleadosService } from '../servicio-empleados.service';
import { EmpleadosService } from '../empleados.service';
@Component({
  selector: 'app-home',
  standalone: false,
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  titulo = 'Listado de Empleados';

  constructor(private miServicio:ServicioEmpleadosService, private empleadosService:EmpleadosService) { }
  // this.empleados = empleadosService.empleados;

  ngOnInit(): void {
       this.empleados = this.empleadosService.empleados;
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
  }

}
