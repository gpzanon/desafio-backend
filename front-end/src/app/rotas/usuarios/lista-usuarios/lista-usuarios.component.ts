import { Component, OnInit } from '@angular/core';
import { UsuariosService } from '../usuarios.service';
import { Router } from '@angular/router';
declare var M;

@Component({
  selector: 'app-lista-usuarios',
  templateUrl: './lista-usuarios.component.html',
  styleUrls: ['./lista-usuarios.component.scss']
})
export class ListaUsuariosComponent implements OnInit {

  constructor(private usuariosService: UsuariosService, private router: Router) { }
  userList:any =[]
  ngOnInit() {
    this.carregarUsuarios()
  }
  carregarUsuarios(){
    this.usuariosService.listarUsuarios().then((res:any)=>{
      this.userList = res;
      console.log(this.userList)
    })
  }
  sair(){
    this.usuariosService.logoff().then((res:any)=>{
      localStorage.clear();
      this.router.navigate(['/login']);
    })
  }
  excluir(id){
    this.usuariosService.excluirUsuario(id).then((res:any)=>{
      console.log(res)
      M.toast({html: res.message});
      this.carregarUsuarios()
    })
  }

}
