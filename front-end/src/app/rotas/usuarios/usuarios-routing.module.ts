import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ListaUsuariosComponent } from './lista-usuarios/lista-usuarios.component';
import { FormUsuariosComponent } from './form-usuarios/form-usuarios.component';
import {AuthGuardService} from '../../guards/auth-guard.service'


const routes: Routes = [
  {path: '', component: ListaUsuariosComponent , canActivate: [AuthGuardService]},
  {path: 'novo', component: FormUsuariosComponent},
  {path: ':id', component: FormUsuariosComponent, canActivate: [AuthGuardService]},
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UsuariosRoutingModule { }
