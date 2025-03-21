/**
 * A class representing a service that processes the data for match schedule
 * and generates leaderboard.
 * 
 * NOTE: MAKE SURE TO IMPLEMENT ALL EXISITNG METHODS BELOW WITHOUT CHANGING THE INTERFACE OF THEM, 
 *       AND PLEASE DO NOT RENAME, MOVE OR DELETE THIS FILE.  
 * 
 */

import { Injectable } from '@angular/core'

// importo HttpClient y HttpHeaders para hacer peticiones al backend y configurar encabezados
import { HttpClient, HttpHeaders } from '@angular/common/http'; 
@Injectable({
  providedIn: 'root'
})
// La clase LeagueService, manejará la lógica de los partidos y el leaderboard.
export class LeagueService {
  // Declaro variable privada apiUrl con el valor del endpoint del backend server
  private apiUrl = 'http://localhost:3001'; 
  // Declaro variable privada matches como un arreglo vacío que almacenará los partidos obtenidos del backend.
  private matches: any[] = []; 
  // Inyecto HttpClient en el constructor.
  constructor (private http: HttpClient) {}

  /**
   * Sets the match schedule.
   * Match schedule will be given in the following form:
   * [
   *      {
   *          matchDate: [TIMESTAMP],
   *          stadium: [STRING],
   *          homeTeam: [STRING],
   *          awayTeam: [STRING],
   *          matchPlayed: [BOOLEAN],
   *          homeTeamScore: [INTEGER],
   *          awayTeamScore: [INTEGER]
   *      },
   *      {
   *          matchDate: [TIMESTAMP],
   *          stadium: [STRING],
   *          homeTeam: [STRING],
   *          awayTeam: [STRING],
   *          matchPlayed: [BOOLEAN],
   *          homeTeamScore: [INTEGER],
   *          awayTeamScore: [INTEGER]
   *      }
   * ]
   *
   * @param {Array} matches List of matches.
   */

  // Implemento el método setMatches para almacenar los partidos recibidos en la variable matches.
  setMatches(matches: any[]): void {
    this.matches = matches;
  }

  /**
   * Returns the full list of matches.
   *
   * @returns {Array} List of matches.
   */
  // Implemento el método getMatches para devolver el arreglo de partidos almacenado.
  getMatches(): any[] {
    return this.matches;
  }

  /**
   * Returns the leaderBoard in a form of a list of JSON objecs.
   *
   * [
   *      {
   *          teamName: [STRING]',
   *          matchesPlayed: [INTEGER],
   *          goalsFor: [INTEGER],
   *          goalsAgainst: [INTEGER],
   *          points: [INTEGER]
   *      },
   * ]
   *
   * @returns {Array} List of teams representing the leaderBoard.
   */
  
  // Implemento el método getLeaderBoard
  getLeaderBoard(): any[] {

    // Creo un objeto estadisticasEquipo para almacenar las estadísticas de cada equipo.
    const estadisticasEquipo: { [key: string]: any } = {};

    // recorro cada partido en el array matches.
    this.matches.forEach(partido => {
      // Solo proceso partidos ya jugados.
      if (partido.matchPlayed) { 
        // Nombre del equipo local
        const equipoLocal = partido.homeTeam;
        // Nombre del equipo visitante.
        const equipoVisitante = partido.awayTeam;

        // Si los equipos no estan en estadisticasEquipo, los inicializamos
        if (!estadisticasEquipo[equipoLocal]) {
          estadisticasEquipo[equipoLocal] = {
            teamName: equipoLocal,
            matchesPlayed: 0,
            goalsFor: 0,
            goalsAgainst: 0,
            points: 0
          };
        }
        if (!estadisticasEquipo[equipoVisitante]) {
          estadisticasEquipo[equipoVisitante] = {
            teamName: equipoVisitante,
            matchesPlayed: 0,
            goalsFor: 0,
            goalsAgainst: 0,
            points: 0
          };
        }

        // Obtengo las estadísticas de los equipos.
        const estadisticasEquipoLocal = estadisticasEquipo[equipoLocal];
        const estadisticasEquipoVisitante = estadisticasEquipo[equipoVisitante];

        // Incremento los partidos jugados.
        estadisticasEquipoLocal.matchesPlayed += 1;
        estadisticasEquipoVisitante.matchesPlayed += 1;

        // Actualizo goles a favor y en contra.
        estadisticasEquipoLocal.goalsFor += partido.homeTeamScore;
        estadisticasEquipoLocal.goalsAgainst += partido.awayTeamScore;
        estadisticasEquipoVisitante.goalsFor += partido.awayTeamScore;
        estadisticasEquipoVisitante.goalsAgainst += partido.homeTeamScore;

        // Calculo los puntos según el resultado.
        if (partido.homeTeamScore > partido.awayTeamScore) { //ganó el local
          estadisticasEquipoLocal.points += 3; 
        } else if (partido.awayTeamScore > partido.homeTeamScore) { //ganó el visitante
          estadisticasEquipoVisitante.points += 3;
        } else { // Empate
          estadisticasEquipoLocal.points += 1;
          estadisticasEquipoVisitante.points += 1;
        }
      }
    });

    // Convierto el objeto estadisticasEquipo en un arreglo
    const ranking = [];
    for (const equipo in estadisticasEquipo) {
      if (estadisticasEquipo.hasOwnProperty(equipo)) {
        ranking.push(estadisticasEquipo[equipo]);
      }
    }


    // Ordeno ranking
    ranking.sort((equipoA, equipoB) => {
      // Primer orden por puntos descendente
      if (equipoB.points !== equipoA.points) return equipoB.points - equipoA.points;

      // Segundo orden en caso de coincidencia de puntos, enfrentamientos directos.
      const vsPartidos = this.matches.filter(
        partido => partido.matchPlayed &&
        ((partido.homeTeam === equipoA.teamName && partido.awayTeam === equipoB.teamName) ||
         (partido.homeTeam === equipoB.teamName && partido.awayTeam === equipoA.teamName))
      );
      // inicializo en 0 los partidos jugados entre los 2 equipos que estoy comparando
      let aEquipoVsPuntos = 0; 
      let bEquipoVsPuntos = 0; 

      // verifico los resultados de los partidos jugados entre los dos equipos y asigno los puntos correspondientes
      vsPartidos.forEach(partido => {
        const aEsLocal = partido.homeTeam === equipoA.teamName;
        const aPuntos = aEsLocal ? partido.homeTeamScore : partido.awayTeamScore;
        const bPuntos = aEsLocal ? partido.awayTeamScore : partido.homeTeamScore;

        if (aPuntos > bPuntos) aEquipoVsPuntos += 3;
        else if (bPuntos > aPuntos) bEquipoVsPuntos += 3;
        else {
          aEquipoVsPuntos += 1;
          bEquipoVsPuntos += 1;
        }
      });

      // Ordeno por puntos en enfrentamientos directos
      if (aEquipoVsPuntos !== bEquipoVsPuntos) return bEquipoVsPuntos - aEquipoVsPuntos;

      // En caso de coincidir los enfrentamientos directos se ordena por diferencia de goles
      const aDiferenciaGoles = equipoA.goalsFor - equipoA.goalsAgainst; 
      const bDiferenciaGoles = equipoB.goalsFor - equipoB.goalsAgainst; 
      if (bDiferenciaGoles !== aDiferenciaGoles) return bDiferenciaGoles - aDiferenciaGoles;

      // Si coincide, se ordena por goles a favor
      if (equipoB.goalsFor !== equipoA.goalsFor) return equipoB.goalsFor - equipoA.goalsFor;

      // Si todo lo anterior coincide, por orden alfabetico
      return equipoA.teamName.localeCompare(equipoB.teamName);
    });
    // Devuelvo el arreglo ordenado.
    return ranking;
  }

  /**
   * Asynchronic function to fetch the data from the server and set the matches.
   */
  // Método fetchData para obtener los partidos.
  async fetchData(): Promise<void> {
    try {
      // Obtengo token.
      const respuestaToken: any = await this.http.get(`${this.apiUrl}/api/v1/getAccessToken`).toPromise();
      const token = respuestaToken.access_token;

      // Configuración de encabezados HTTP.
      const headers = new HttpHeaders({
        Authorization: `Bearer ${token}`
      });

      // Obtengo Partidos.
      const respuestaPartidos: any = await this.http.get(`${this.apiUrl}/api/v1/getAllMatches`, { headers }).toPromise();
      this.setMatches(respuestaPartidos.matches);
    } catch (error) {
      console.error('Error fetching data:', error);
      throw error;
    }
  }
}