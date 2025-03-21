// se importan dependencias y servicios
import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ScheduleComponent } from './schedule.component';
import { HttpClientModule } from '@angular/common/http';
import { LeagueService } from '../../services/league.service';

describe('ScheduleComponent', () => {
  let component: ScheduleComponent;
  let fixture: ComponentFixture<ScheduleComponent>;
  // se importa HttpClientModule y se provee LeagueService
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ScheduleComponent ],
      imports: [HttpClientModule],
      providers: [LeagueService]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ScheduleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
