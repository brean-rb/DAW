import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { ServicioEmpleadosService } from '../servicio-empleados.service';
import { Empleado } from '../empleado.model';
import { EmpleadosService } from '../empleados.service';

@Component({
  selector: 'app-caracteristicas-empleados-c',
  standalone: false,
  templateUrl: './caracteristicas-empleados-c.component.html',
  styleUrls: ['./caracteristicas-empleados-c.component.css']
})
export class CaracteristicasEmpleadosCComponent implements OnInit {

  @Output () CaracteristicasEmpleados = new EventEmitter<string>();

  agregaCaracteristicas(value:string){
   this.miServicio.muestraMensaje("Vas a agregar la caracteristica: \n" + value);
   this.CaracteristicasEmpleados.emit(value);

  }

  constructor(private miServicio:ServicioEmpleadosService, private empleadosService:EmpleadosService) {
   }
   empleados:Empleado[]=[];
  ngOnInit(): void {
    this.empleados=this.empleadosService.empleados;

  }
}
