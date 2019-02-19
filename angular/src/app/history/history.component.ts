import { Component, OnInit } from '@angular/core';
import { CrudService } from './../services/crud.service';
import 'rxjs/add/operator/takeUntil';
import { ReplaySubject, Observable } from 'rxjs';

@Component({
  selector: 'app-history',
  templateUrl: './history.component.html',
  styleUrls: ['./history.component.scss']
})
export class HistoryComponent implements OnInit {

  constructor(private crud: CrudService) { }

  destruido: ReplaySubject<boolean> = new ReplaySubject(1);
  erro;
  historico: Observable<any>;


  ngOnInit() {
    this.getHistory();
  }

  getHistory() {
    this.crud.leRegistro('list').takeUntil(this.destruido).subscribe((data) => {
      this.historico = data;
      console.log(this.historico);
    }, error => {
      this.erro = error;
      console.log(this.erro);
    });
  }

  ngOnDestory(){
    this.destruido.next(true);
    this.destruido.complete();
  }

}
