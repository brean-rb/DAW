import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Empleado } from './empleado.model';
import { CommonModule } from '@angular/common';
import { EmpleadoInfoComponent } from './empleado-info/empleado-info.component';
import { ConfirmacionAnadirService } from './confirmacion-anadir.service';
import { EmpleadosService } from './empleados.service';
@Component({
  selector: 'app-root',
  imports: [FormsModule,CommonModule, EmpleadoInfoComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
  providers: [
    ConfirmacionAnadirService,
    EmpleadosService
  ],
})
export class AppComponent implements OnInit{
  title = 'Empleados';

    constructor(private miServicio:ConfirmacionAnadirService, private miBase:EmpleadosService){

     // this.empleados=this.miBase.empleados;
    }
  ngOnInit(): void {
    this.empleados=this.miBase.empleados;
  }
 
  Cuadronombre:string = "";
  Cuadroapellido:string = "";
  Cuadrocargo:string = "";
  Cuadrosalario:number=0;

  empleados:Empleado[]=[];

  agregarEmpleado(){
    let miEmpleado = new Empleado(this.Cuadronombre,this.Cuadroapellido,this.Cuadrocargo,this.Cuadrosalario);
    this.miServicio.muestraMensaje("Informacion del empleado al añadir:\n 1.Nombre: " + miEmpleado.nombre + "\n 2.Apellido: " + miEmpleado.apellido + "\n 3.Cargo: " + miEmpleado.cargo + " \n 4.Salario: " + miEmpleado.salario + "€");
    this.miBase.anadirEmpleado(miEmpleado);
  }
}
