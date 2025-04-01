import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-empleado',
  imports: [],
  templateUrl: './empleado.component.html',
  styleUrl: './empleado.component.css'
})
export class EmpleadoComponent implements OnInit{
  
  nombre = "Ruben";
  apellido = "Ferrer";
   edad=20;
  //empresa="asistecs";

  habilitarCuadrotexto = false;
 
  usuRegistrado = false;

  textodeRegistro="no hay nadie registrado ";
  getRegistroUsuario(){
    this.usuRegistrado = false;
  }

  setUsuarioRegs(event:Event){
  //  this.textodeRegistro = "El usuario ha sido registrado";
if((<HTMLInputElement>event.target).value === "SI"){
  this.textodeRegistro = "El usuario ha sido registrado";
}else{
  this.textodeRegistro = "No hay nadie registrado";
}
  }

  constructor (){}
  
  ngOnInit(): void {
  }

}
