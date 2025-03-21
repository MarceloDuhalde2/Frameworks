import { Component, OnInit } from '@angular/core';
// Se importa LeagueService para obtener los datos de los partidos
import { LeagueService } from '../../services/league.service'; 

@Component({
  selector: 'app-schedule',
  templateUrl: './schedule.component.html',
  styleUrls: ['./schedule.component.scss']
})
export class ScheduleComponent implements OnInit {
  // Declaro un arreglo para almacenar los partidos
  matches: any[] = [];

  // se inyecta LeagueService en el constructor
  constructor(private leagueService: LeagueService) { }

  // implemento ngOnInit
  async ngOnInit(): Promise<void> {
    try {
      // Obtengo los partidos del backend
      await this.leagueService.fetchData();
      // Obtengo los partidos con getMatches()
      this.matches = this.leagueService.getMatches();
    } catch (error) { 
      console.error('Error on load matches:', error);
    }
  }
  // Método para formatear fecha
  formatDate(timestamp: number): string { 
    const date = new Date(timestamp);
    // formateo minutos
    const minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes().toString();
    // formateo la fecha como D.M.YYYY hh:mm (e.g., 5.5.2022 11:50)
    return `${date.getDate()}.${date.getMonth() + 1}.${date.getFullYear()} ${date.getHours()}:${minutes}`;
  }
}
