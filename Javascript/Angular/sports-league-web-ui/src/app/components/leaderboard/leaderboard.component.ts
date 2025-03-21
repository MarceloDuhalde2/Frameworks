import { Component, OnInit } from '@angular/core';
// importo el servicio
import { LeagueService } from '../../services/league.service';

@Component({
  selector: 'app-leaderboard',
  templateUrl: './leaderboard.component.html',
  styleUrls: ['./leaderboard.component.scss']
})
export class LeaderboardComponent implements OnInit {
  // Arreglo el ranking de equipos
  leaderboard: any[] = [];
  
  constructor(private leagueService: LeagueService) {}

  async ngOnInit(): Promise<void> {
    try {
      // Verifico datos cargados
      await this.leagueService.fetchData();
      // Se obtiene el ranking
      this.leaderboard = this.leagueService.getLeaderBoard();
    } catch (error) {
      console.error('Error on load leaderboard:', error);
    }
  }

    // Método diferencia de goles
  getGoalDifference(team: any): number {
    return team.goalsFor - team.goalsAgainst;
  }

}