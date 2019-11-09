import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';


@Injectable({
  providedIn: 'root'
})
export class AuthGuardService implements CanActivate {

  constructor(private router: Router) { }
  public isAuthenticated: boolean;

  canActivate() {
    
    if (localStorage.getItem('Token')) {
      return true;
    } else {
      this.router.navigate(['/login']);
      return false;
    }
  }
}