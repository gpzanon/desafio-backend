import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {API_URL} from '../../../config'

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(private http: HttpClient ) { }

  logar(dados){
    return new Promise((resolve, reject) => {
      this.http.post<any>(`${API_URL}/login`,dados).subscribe(resolve);
    });
  }
}
