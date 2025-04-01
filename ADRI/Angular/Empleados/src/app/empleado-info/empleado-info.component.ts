import { Component, Input, OnInit } from '@angular/core';
import { Empleado } from '../empleado.model';
import { EmpleadoTiposComponent } from "../empleado-tipos/empleado-tipos.component";
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-empleado-info',
  standalone: true, // Asegúrate de que sea independiente
  templateUrl: './empleado-info.component.html',
  styleUrls: ['./empleado-info.component.css'],
  imports: [EmpleadoTiposComponent, CommonModule]
})
export class EmpleadoInfoComponent implements OnInit {
  @Input() empleado: Empleado;
  @Input() i:number;
  constructor(){}
  ngOnInit(): void {
      
  }
  tipos = [""];
  agregarTipo(tipo:string){
    this.tipos.push(tipo);
  }
}
