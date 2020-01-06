import { Component, OnInit, ViewChild } from '@angular/core';
import { EstanciaVehiculoService } from 'src/app/services/estancia-vehiculo.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Reporte } from '../../../models/reporte';
import * as jsPDF from 'jspdf';

@Component({
  selector: 'app-reporte-importe',
  templateUrl: './reporte-importe.component.html',
  styleUrls: ['./reporte-importe.component.css']
})
export class ReporteImporteComponent implements OnInit {

  nombre: string

  reporte:any = {};
  constructor(
    private _resultadoService: EstanciaVehiculoService,
    private _activatedRoute: ActivatedRoute
  ) { }

  ngOnInit() {
    this.getInforme();
  }
  getInforme() {
    this._activatedRoute.params.subscribe(params => {
    this._resultadoService.getInforme().subscribe(response => {
      this.reporte = response.data; 
      console.log(this.reporte); 

        });
    });
  }

  downloadPDF(){

    var doc = new jsPDF();
    var col = ["Num. Placa", "Tiempo estacionado(MIN)", "Cantidad a Pagar"];
    var rows = [];
    console.log(this.reporte);

    this.reporte.forEach(element => {
      const temp = [element.placa, element.tiempo_estacionado, element.pago];
      rows.push(temp);

    });

    doc.autoTable(col, rows);
    doc.save(this.nombre+'.pdf');



  }
}

