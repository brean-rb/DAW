import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmpleadoTiposComponent } from './empleado-tipos.component';

describe('EmpleadoTiposComponent', () => {
  let component: EmpleadoTiposComponent;
  let fixture: ComponentFixture<EmpleadoTiposComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EmpleadoTiposComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EmpleadoTiposComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
