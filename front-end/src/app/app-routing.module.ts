import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './rotas/login/login/login.component';

const routes: Routes = [
  {path: 'usuarios', loadChildren:'./rotas/usuarios/usuarios.module#UsuariosModule'},
  {path: 'login', component:LoginComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
