import { Component, OnInit, OnDestroy} from '@angular/core';
import { HomepageService } from 'src/app/services/homepage.service';
import { UserLogin } from 'src/app/models/user-login';
import { UserRegister } from 'src/app/models/user-register';
import { TokenService } from 'src/app/services/token.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.scss']
})

export class HomepageComponent implements OnInit {

  public userLogin = new UserLogin();
  public userRegister = new UserRegister();

  
  constructor(private homepageService: HomepageService, 
              private tokenService: TokenService,
              private router: Router,
              private authService: AuthService) {
  }

  login() {
    this.homepageService.login(this.userLogin).subscribe(
      res => {
        this.handle(res);
      },
      err => {
        console.log(err.error);
      }
    )
  }

  test() {
    this.homepageService.test().subscribe(
      res => {
        console.log(res);
      }
    )
  }

  logout() {
    localStorage.removeItem('token');
  }

  handle(data: any) {
    console.log(data.access_token);
    this.tokenService.handle(data.access_token);
  }

  register() {
    this.homepageService.register(this.userRegister).subscribe(
      res => {
        
      },
      err => {

      }
    )
  }

  ngOnInit() {
    
  }
}

