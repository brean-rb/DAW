import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ConfirmacionAnadirService {

  constructor() { }


    muestraMensaje(mensaje:string){
      alert(mensaje);
    }

}
