import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';

import { NgxMaskModule } from 'ngx-mask'

import { UsuariosRoutingModule } from './usuarios-routing.module';
import { ListaUsuariosComponent } from './lista-usuarios/lista-usuarios.component';
import { FormUsuariosComponent } from './form-usuarios/form-usuarios.component';
import { ReactiveFormsModule } from '@angular/forms';




@NgModule({
  declarations: [ListaUsuariosComponent, FormUsuariosComponent],
  imports: [
    CommonModule,
    UsuariosRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    NgxMaskModule.forRoot()
  ]
})
export class UsuariosModule { }
