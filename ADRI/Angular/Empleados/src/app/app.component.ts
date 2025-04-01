import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Empleado } from './empleado.model';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-root',
  imports: [FormsModule,CommonModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Empleados';
  empleados:Empleado[]=[
    new Empleado("Ruben","Ferrer","Informatico",1800),
    new Empleado("Adrian","Marschal","Tecnico",2200),
    new Empleado("Noe","Gonzalez","Recepcion",1500),
    new Empleado("Roberto","Tudor","Mantenimiento",1200),
  ];
  Cuadronombre:string = "";
  Cuadroapellido:string = "";
  Cuadrocargo:string = "";
  Cuadrosalario:number=0;

  agregarEmpleado(){
    let miEmpleado = new Empleado(this.Cuadronombre,this.Cuadroapellido,this.Cuadrocargo,this.Cuadrosalario);
    this.empleados.push(miEmpleado);
  }
}
