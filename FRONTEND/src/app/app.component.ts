import { Component } from '@angular/core';
import { CartState } from '../../shared/states/cart-state';
import { Store, Select } from '@ngxs/store';
import { Observable } from 'rxjs';
import { AuthenticationService } from 'src/app/services/authentication.service';
import { User } from 'shared/models/User';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'angular-app';
  nb$: Observable<number>;
  currentUser!: Observable<User>;

  constructor(
    private store: Store,
    private authenticationService: AuthenticationService
  ) {
    this.nb$ = this.store.select(CartState.getProductsNb);
  }

  ngOnInit(): void {
    this.currentUser = this.authenticationService.currentUser;
  }

  ngOnDestroy(): void {}

  getCount() {}
}
