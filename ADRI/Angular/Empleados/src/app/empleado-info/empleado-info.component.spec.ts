import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EmpleadoInfoComponent } from './empleado-info.component';

describe('EmpleadoInfoComponent', () => {
  let component: EmpleadoInfoComponent;
  let fixture: ComponentFixture<EmpleadoInfoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EmpleadoInfoComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EmpleadoInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
