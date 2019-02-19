import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { TableComponent } from './table/table.component';
import { HistoryComponent } from './history/history.component';

const routes: Routes = [
  {path:'table', component: TableComponent },
  {path: 'home', component: HomeComponent},
  {path:'history', component: HistoryComponent},
  {path: '**', redirectTo: 'home'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
