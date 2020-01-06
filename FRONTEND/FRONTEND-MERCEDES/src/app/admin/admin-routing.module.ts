import { Routes } from '@angular/router';

import { MenuComponent } from '../components/menu/menu.component';
import { EntradaComponent } from '../components/estanciaVehiculo/entrada/entrada.component';
import { SalidaComponent } from '../components/estanciaVehiculo/salida/salida.component';
import { OficialComponent } from '../components/vehiculos/oficial/oficial.component';
import { ResidenteComponent } from '../components/vehiculos/residente/residente.component';
import { ComenzarMesComponent } from '../components/estanciaVehiculo/comenzar-mes/comenzar-mes.component';
import { NuevoTipoComponent } from '../components/tipoVehiculo/nuevo-tipo/nuevo-tipo.component';
import { ReporteImporteComponent } from '../components/reporte/reporte-importe/reporte-importe.component';

export const AdminRoutingModule: Routes = [
    { path: 'menu', component: MenuComponent },
    { path: 'entrada', component: EntradaComponent },
    { path: 'salida', component: SalidaComponent },
    { path: 'comenzar', component: ComenzarMesComponent },
    { path: 'vehiculo-oficial', component: OficialComponent },
    { path: 'vehiculo-residente', component: ResidenteComponent },
    { path: 'tipo-vehiculo', component: NuevoTipoComponent },
    { path: 'reporte-importe', component: ReporteImporteComponent },

];
