import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ListaUsuariosComponent } from './lista-usuarios/lista-usuarios.component';
import { FormUsuariosComponent } from './form-usuarios/form-usuarios.component';


const routes: Routes = [
  {path: '', component: ListaUsuariosComponent},
  {path: 'novo', component: FormUsuariosComponent},
  {path: ':id', component: FormUsuariosComponent},
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UsuariosRoutingModule { }
