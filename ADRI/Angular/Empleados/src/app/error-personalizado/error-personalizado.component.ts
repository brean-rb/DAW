import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-error-personalizado',
  templateUrl: './error-personalizado.component.html',
  styleUrls: ['./error-personalizado.component.css']
})
export class ErrorPersonalizadoComponent implements OnInit {

  constructor(private router:Router) { }

  ngOnInit(): void {
  }
  volverHome(){

    this.router.navigate(['']);
  }

}
