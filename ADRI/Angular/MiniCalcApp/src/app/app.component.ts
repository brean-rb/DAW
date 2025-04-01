import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
@Component({
  selector: 'app-root',
  imports: [FormsModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'Calculadora: ';
  num1:string='0';
  num2:string='0';
  result:number=0;

  calcular(operacion:string):void{
    if (operacion == "+") {
      this.result=parseInt(this.num1)+parseInt(this.num2);
    } else if (operacion == "-") {
      this.result=parseInt(this.num1)-parseInt(this.num2);
    }
  }
}
