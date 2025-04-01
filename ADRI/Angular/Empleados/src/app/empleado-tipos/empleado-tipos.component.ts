import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { ConfirmacionAnadirService } from '../confirmacion-anadir.service';

@Component({
  selector: 'app-empleado-tipos',
  imports: [],
  templateUrl: './empleado-tipos.component.html',
  styleUrl: './empleado-tipos.component.css',
})
export class EmpleadoTiposComponent implements OnInit{

  @Output() aspectos = new EventEmitter<string>();

  constructor (private miServicio:ConfirmacionAnadirService) {  }
  
  ngOnInit():void{

  }

  ponerAspectos(value:string){
    this.miServicio.muestraMensaje("Se va a añadir la caracteristica:\n" + value);
    this.aspectos.emit(value);
  }

}
