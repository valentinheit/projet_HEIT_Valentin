import { Component, Input } from '@angular/core';
import { Select, Store } from '@ngxs/store';
import { Observable, Subscription } from 'rxjs';

import {
  AddProductToCart,
  DelProductFromCart,
} from 'shared/actions/cart.action';
import { Product } from 'shared/models/product';
import { CartState } from 'shared/states/cart-state';
import { ProductsService } from 'src/app/services/products.service';

@Component({
  selector: 'app-catalogue',
  templateUrl: './catalogue.component.html',
  styleUrls: ['./catalogue.component.scss'],
})
export class CatalogueComponent {
  products: Product[] = [];
  subscription!: Subscription;
  filterItem: string = '';
  @Select(CartState.getProductsFromCart) products$!: Observable<Product[]>;

  constructor(private store: Store, private productService: ProductsService) {}

  ngOnInit(): void {
    this.products = this.productService.getProducts();
    this.subscription = this.productService
      .getProductsObs()
      .subscribe((data) => (this.products = data));
  }

  getFilterItem(event: string): void {
    this.filterItem = event;
  }

  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }

  addToCart(product: Product) {
    this.store.dispatch(new AddProductToCart(product));
  }

  deleteFromCart(product: Product) {
    this.store.dispatch(new DelProductFromCart(product));
  }
}
