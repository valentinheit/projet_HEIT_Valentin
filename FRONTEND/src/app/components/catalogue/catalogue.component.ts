import { Component, Input } from '@angular/core';
import { Select, Store } from '@ngxs/store';
import { Observable } from 'rxjs';

import {
  AddProductToCart,
  DelProductFromCart,
} from 'shared/actions/cart.action';
import { Product } from 'shared/models/product';
import { CartState } from 'shared/states/cart-state';

@Component({
  selector: 'app-catalogue',
  templateUrl: './catalogue.component.html',
  styleUrls: ['./catalogue.component.scss'],
})
export class CatalogueComponent {
  products: Product[] = [];
  filterItem: string = '';
  @Select(CartState.getProductsFromCart) products$!: Observable<Product[]>;
  ngOnInit(): void {}

  constructor(private store: Store) {}

  getProducts(event: Product[]): void {
    this.products = event;
  }

  getFilterItem(event: string): void {
    this.filterItem = event;
  }

  addToCart(product: Product) {
    this.store.dispatch(new AddProductToCart(product));
  }

  deleteFromCart(product: Product) {
    this.store.dispatch(new DelProductFromCart(product));
  }
}
