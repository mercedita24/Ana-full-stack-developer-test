import { Component, OnInit } from '@angular/core';
import { TipoVehiculoService } from 'src/app/services/tipo-vehiculo.service';
import { TipoVehiculo } from 'src/app/models/tipoVehiculo';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-nuevo-tipo',
  templateUrl: './nuevo-tipo.component.html',
  styleUrls: ['./nuevo-tipo.component.css']
})
export class NuevoTipoComponent implements OnInit {

  tipo = new TipoVehiculo();

  constructor(
        private _tipoService: TipoVehiculoService,
        private _router: Router,
        private _toastr: ToastrService
  ) { }

  ngOnInit() {
  }

  saveTipo() {
    
    this._tipoService.saveTipo(this.tipo).subscribe(response => {
        this._toastr.success(`Tipo de Vehiculo ${this.tipo.nombre} registrado con éxito`, 'Guardado');
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
