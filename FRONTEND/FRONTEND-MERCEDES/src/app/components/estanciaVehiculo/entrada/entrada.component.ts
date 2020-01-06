import { Component, OnInit } from '@angular/core';
import { EstanciaVehiculoService } from 'src/app/services/estancia-vehiculo.service';
import { Vehiculo } from 'src/app/models/vehiculo';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-entrada',
  templateUrl: './entrada.component.html',
  styleUrls: ['./entrada.component.css']
})
export class EntradaComponent implements OnInit {

 vehiculo = new Vehiculo();


  constructor(
        private _estanciaService: EstanciaVehiculoService,
        private _router: Router,
        private _toastr: ToastrService
  ) { }

  ngOnInit() {

  }

  saveEntrada() {
    console.log(this.vehiculo.placa);
    
    this._estanciaService.saveEntrada(this.vehiculo).subscribe(response => {
        this._toastr.success(`Entrada registrada con éxito`, 'Guardado');
        this._router.navigateByUrl('/menu')
    }, error => {
      if (error.error) {
        for (let errores of Object.values(error.error)) {
            for (let err of Object.values(errores)) {
                this._toastr.error(err, 'Error', { timeOut: 2500 })
              }
            }
          }
      })
  }

}
