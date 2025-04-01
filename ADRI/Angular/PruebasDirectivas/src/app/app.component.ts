import { Component } from '@angular/core';
import {FormsModule} from '@angular/forms';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-root',
  imports: [FormsModule,CommonModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Registro de Usuarios';

    mensaje:string="";
    registrado:boolean = false;
    nombre:string = "";
    apellido:string = "";
    cargo:string = "";
    entradas:{titulo:string}[];


    constructor(){
      this.entradas=[
        {titulo:"Estoy aprendiendo angular"},
        {titulo:"Estoy aprendiendo java"},
        {titulo:"Estoy aprendiendo pyhton"},
        {titulo:"Estoy aprendiendo c#"},
        {titulo:"Estoy aprendiendo php"},
        {titulo:"Estoy aprendiendo js"},
        {titulo:"Estoy aprendiendo jquery"},
      ]
    }

  registrarUsuario():void{
    this.registrado=true;
    this.mensaje="Usuario registrado con exito";
  }
}
