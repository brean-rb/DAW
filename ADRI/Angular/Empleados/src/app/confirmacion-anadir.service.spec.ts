import { TestBed } from '@angular/core/testing';

import { ConfirmacionAnadirService } from './confirmacion-anadir.service';

describe('ConfirmacionAnadirService', () => {
  let service: ConfirmacionAnadirService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ConfirmacionAnadirService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
