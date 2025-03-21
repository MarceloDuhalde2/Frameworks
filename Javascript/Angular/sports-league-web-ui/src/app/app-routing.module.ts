/**
 * PLEASE DO NOT RENAME OR REMOVE ANY OF THE CODE BELOW. 
 * YOU CAN ADD YOUR CODE TO THIS FILE TO EXTEND THE FEATURES TO USE THEM IN YOUR WORK.
 */
// Importo dependencias y componentes
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ScheduleComponent } from './components/schedule/schedule.component';
import { LeaderboardComponent } from './components/leaderboard/leaderboard.component';
import { NotFoundComponent } from './components/not-found/not-found.component';

const routes: Routes = [
  // Se configuran todas las rutas
  { path: '', component: ScheduleComponent },
  { path: 'schedule', component: ScheduleComponent },
  { path: 'leaderboard', component: LeaderboardComponent },
  { path: '**', component: NotFoundComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
