import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Select } from '@ngxs/store';
import { Observable } from 'rxjs';
import { CartState } from 'shared/states/cart-state';
import { AuthenticationService } from 'src/app/services/authentication.service';
import { User } from 'shared/models/User';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent {
  @Select(CartState.getProductsNb) productNb$!: Observable<number>;
  currentUser!: User;
  constructor(
    private authenticationService: AuthenticationService,
    private router: Router
  ) {
    this.authenticationService.currentUser.subscribe(
      (user) => (this.currentUser = user)
    );
  }

  ngOnInit(): void {}

  logout(): void {
    this.authenticationService.logout();
    this.router.navigate(['']);
  }
}
