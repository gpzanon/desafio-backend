import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import {API_URL} from '../../config'

@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  constructor(private http: HttpClient) { }
  private head= new HttpHeaders()
  .append('x-requested-with', 'XMLHttpRequest')
  .append('content-type', 'application/json')
  .append('authorization', localStorage.getItem('Token'))

  public listarUsuarios(){
    return new Promise((resolve, reject) => {
      this.http.get<any>(`${API_URL}/users`, {headers: this.head}).subscribe(resolve);
    });
  }
  public buscarUsuario(id){
    return new Promise((resolve, reject) => {
      this.http.get<any>(`${API_URL}/users/${id}`, {headers: this.head}).subscribe(resolve);
    });
  }
  public editarUsuario(dados){
    return new Promise((resolve, reject) => {
      this.http.put<any>(`${API_URL}/users/${dados.id}`, dados, {headers: this.head}).subscribe(resolve);
    });
  }
  public novoUsario(dados){
    return new Promise((resolve, reject) => {
      this.http.post<any>(`${API_URL}/novo`, dados).subscribe(resolve);
    });
  }
  public excluirUsuario(id){
    return new Promise((resolve, reject) => {
      this.http.delete<any>(`${API_URL}/users/${id}`, {headers: this.head}).subscribe(resolve);
    });
  }
  public logoff(){
    return new Promise((resolve, reject) => {
      this.http.get<any>(`${API_URL}/logout`, {headers: this.head}).subscribe(resolve);
    });
  }
}
