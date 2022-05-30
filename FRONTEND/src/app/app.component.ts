import { Component } from '@angular/core';
import { CartState } from '../../shared/states/cart-state';
import { Store, Select } from '@ngxs/store';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent {
  title = 'angular-app';
  nb$: Observable<number>;

  constructor(private store: Store) {
    this.nb$ = this.store.select(CartState.getProductsNb);
  }

  ngOnInit(): void {}

  ngOnDestroy(): void {}

  getCount() {}
}
