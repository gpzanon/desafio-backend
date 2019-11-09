import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { UsuariosService } from '../usuarios.service';
import { ThrowStmt } from '@angular/compiler';
declare var M;

@Component({
  selector: 'app-form-usuarios',
  templateUrl: './form-usuarios.component.html',
  styleUrls: ['./form-usuarios.component.scss']
})
export class FormUsuariosComponent implements OnInit {

  constructor(private fb: FormBuilder,
             private router: Router, 
             private route: ActivatedRoute,
             private usuariosService: UsuariosService) { }
  formUser;
  id = null;
  ngOnInit() {
    this.id = null;
    this.formUser = this.fb.group({
      id : [''],
      name: ['', Validators.required],
      cpf: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
    if(this.route.snapshot.paramMap.get('id')){
      this.id = this.route.snapshot.paramMap.get('id');
      this.usuariosService.buscarUsuario(this.id).then((res:any)=>{
        this.formUser.controls.id.setValue(res.id);
        this.formUser.controls.name.setValue(res.name);
        this.formUser.controls.cpf.setValue(res.cpf);
        this.formUser.controls.email.clearValidators();
        this.formUser.controls.password.clearValidators();
        this.formUser.controls.email.updateValueAndValidity();
        this.formUser.controls.password.updateValueAndValidity();
        M.updateTextFields();
      })
    }
  }

  salvar(){
    if(this.formUser.valid){
      if (this.id){
        this.usuariosService.editarUsuario(this.formUser.getRawValue()).then((res:any)=>{
          console.log(res)
          M.toast({html: res.message});
          this.router.navigate(['/'])
        })
      }else{
        this.usuariosService.novoUsario(this.formUser.getRawValue()).then((res:any)=>{
          console.log(res)
          M.toast({html: res.message});
          this.router.navigate(['/'])
        })
      }
    }
  }

}
