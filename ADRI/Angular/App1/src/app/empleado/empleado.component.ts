import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-empleado',
  standalone: true, // Asegúrate de que sea un componente independiente
  imports: [FormsModule], // Importa FormsModule aquí
  templateUrl: './empleado.component.html',
  styleUrls: ['./empleado.component.css']
})
export class EmpleadoComponent {
  nombre = "Ruben";
  apellido = "Ferrer";
  edad = 20;
  empresa = "asistecs";

  habilitarCuadrotexto = false;
  usuRegistrado = false;

  textodeRegistro = "no hay nadie registrado";

  getRegistroUsuario() {
    this.usuRegistrado = false;
  }

  setUsuarioRegs(event: Event) {
    if ((<HTMLInputElement>event.target).value === "SI") {
      this.textodeRegistro = "El usuario ha sido registrado";
    } else {
      this.textodeRegistro = "No hay nadie registrado";
    }
  }
}
