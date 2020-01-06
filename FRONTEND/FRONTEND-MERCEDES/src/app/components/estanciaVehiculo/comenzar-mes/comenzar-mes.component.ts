import { Component, OnInit } from '@angular/core';
import { EstanciaVehiculoService } from 'src/app/services/estancia-vehiculo.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-comenzar-mes',
  templateUrl: './comenzar-mes.component.html',
  styleUrls: ['./comenzar-mes.component.css']
})
export class ComenzarMesComponent implements OnInit {

  constructor(
        private _estanciaService: EstanciaVehiculoService,
        private _router: Router,
  ) { }

  ngOnInit() {
    this.inicioMes();
    console.log(this.inicioMes());
  }

  inicioMes(){
    this._estanciaService.inicioMes().subscribe(response => {}) 
  }
  
}
