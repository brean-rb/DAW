import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-caracteristicas-empleados-c',
  templateUrl: './caracteristicas-empleados-c.component.html',
  styleUrls: ['./caracteristicas-empleados-c.component.css']
})
export class CaracteristicasEmpleadosCComponent {
  @Output() CaracteristicasEmpleados = new EventEmitter<string>();

  agregaCaracteristicas(value: string) {
    if (value.trim() !== '') {
      this.CaracteristicasEmpleados.emit(value);
    }
  }
}
