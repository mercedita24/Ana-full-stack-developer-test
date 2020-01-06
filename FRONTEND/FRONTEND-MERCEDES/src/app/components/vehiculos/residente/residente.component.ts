import { Component, OnInit } from '@angular/core';
import { VehiculosService } from 'src/app/services/vehiculos.service';
import { Vehiculo } from 'src/app/models/vehiculo';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-residente',
  templateUrl: '../residente/residente.component.html',
  styleUrls: ['../residente/residente.component.css']
})
export class ResidenteComponent implements OnInit {

  vehiculo = new Vehiculo();

  constructor(
        private _vehiculoService: VehiculosService,
        private _router: Router,
        private _toastr: ToastrService
  ) { }

  ngOnInit() {
  }
  saveResidente() {
    
  this._vehiculoService.saveResidente(this.vehiculo).subscribe(response => {
      this._toastr.success(`Vehiculo Residente ${this.vehiculo.placa} dado de alta con éxito`, 'Guardado');
      this._router.navigateByUrl('/menu')
  }, error => {
    if (error.error.data) {
      for (let errores of Object.values(error.error.data)) {
          for (let err of Object.values(errores)) {
              this._toastr.error(err, 'Error', { timeOut: 2500 })
            }
          }
        }
      })
    }
}