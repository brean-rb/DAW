import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CaracteristicasEmpleadosCComponent } from './caracteristicas-empleados-c.component';

describe('CaracteristicasEmpleadosCComponent', () => {
  let component: CaracteristicasEmpleadosCComponent;
  let fixture: ComponentFixture<CaracteristicasEmpleadosCComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CaracteristicasEmpleadosCComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CaracteristicasEmpleadosCComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
