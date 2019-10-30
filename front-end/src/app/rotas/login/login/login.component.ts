import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { LoginService } from './login.service';
import { Router } from '@angular/router';
import { AuthGuardService } from 'src/app/guards/auth-guard.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(private fb: FormBuilder, 
              private loginService: LoginService,
              private route: Router,
              public authGuardService: AuthGuardService) { }
  formLogin;
  invalid:boolean;
  ngOnInit() {
    this.formLogin = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    })
    
  }
  logar(){
    if(this.formLogin.valid){
      this.loginService.logar(this.formLogin.getRawValue()).then((res:any)=>{
        this.invalid = false;
        localStorage.setItem('Token', res.token_type + ' '+res.access_token);
        this.authGuardService.isAuthenticated = true;
        this.route.navigate(['usuarios']);
      })
    }else{
      for (let i in this.formLogin.controls){
        this.formLogin.controls[i].markAsTouched();
        this.formLogin.controls[i].markAsDirty()
      }
    }
  }
  novo(){
    this.route.navigate(['usuarios/novo']);
  }

}
