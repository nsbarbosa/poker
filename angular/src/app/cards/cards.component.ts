import { Component, OnInit } from '@angular/core';
import { CrudService } from './../services/crud.service';
import 'rxjs/add/operator/takeUntil';
import { ReplaySubject } from 'rxjs';
import { Card } from './../shared/card';
import { baseURL } from './../shared/baseurl';

@Component({
  selector: 'app-cards',
  templateUrl: './cards.component.html',
  styleUrls: ['./cards.component.scss']
})
export class CardsComponent implements OnInit {

  constructor(private crud: CrudService) { }

  ngOnInit() {
  }

  cartas: Array<Card> = [];
  mao1 = [];
  mao2 = [];
  ganhador: number = null;
  erro;
  msgButton: string = 'Começar';
  msg: string;
  destruido: ReplaySubject<boolean> = new ReplaySubject(1);
  URL_PADRAO = baseURL;



  montaMaos() {
    this.crud.leRegistro('game').takeUntil(this.destruido).subscribe(
      (data) => {
        this.cartas = data[0];
        console.log(data);

        for(let i = 0; i < (this.cartas.length / 2) ; i++) {
          this.mao1.push(this.cartas[i]);
        }
        for(let i = 5; i < this.cartas.length ; i++) {
          this.mao2.push(this.cartas[i]);
        }

        console.log(this.mao1);
        console.log(this.mao2);
        this.ganhador = data[1];
        console.log(`Ganhador ${data[1]}`);
      },
      error => {
        this.erro = error;
        console.log(this.erro);
      }
    );
  }

  consultaCartas() {
    if(this.cartas.length != 0){
      this.cartas = [];
      this.mao1 = [];
      this.mao2 = [];
      this.msg = 'Clique no botão abaixo para jogar novamente';
      this.ganhador = null;
      this.msgButton = 'Começar';
      console.log(this.msg);
    } else {
      this.msgButton = 'Jogar Novamente';
      this.msg = null;
      this.montaMaos();
    }
  }

  ngOnDestory(){
    this.destruido.next(true);
    this.destruido.complete();
  }

}
