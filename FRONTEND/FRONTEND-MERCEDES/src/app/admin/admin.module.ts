import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms'; 
import { AdminRoutingModule } from './admin-routing.module';

import { MenuComponent } from '../components/menu/menu.component';
import { EntradaComponent } from '../components/estanciaVehiculo/entrada/entrada.component';
import { SalidaComponent } from '../components/estanciaVehiculo/salida/salida.component';
import { OficialComponent } from '../components/vehiculos/oficial/oficial.component';
import { ResidenteComponent } from '../components/vehiculos/residente/residente.component';
import { ComenzarMesComponent } from '../components/estanciaVehiculo/comenzar-mes/comenzar-mes.component';
import { NuevoTipoComponent } from '../components/tipoVehiculo/nuevo-tipo/nuevo-tipo.component';
import { ReporteImporteComponent } from '../components/reporte/reporte-importe/reporte-importe.component';

@NgModule({
    imports: [
      CommonModule,
      RouterModule.forChild(AdminRoutingModule),
      FormsModule,
      ReactiveFormsModule,
      HttpClientModule,
    ],
    declarations: [
        MenuComponent,
        EntradaComponent,
        SalidaComponent,
        OficialComponent,
        ResidenteComponent,
        ComenzarMesComponent,
        NuevoTipoComponent,
        ReporteImporteComponent,
    ]
  })
  export class AdminModule { }





