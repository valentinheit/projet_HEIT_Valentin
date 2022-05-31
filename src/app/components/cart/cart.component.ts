import { Component, OnInit } from '@angular/core';
import { Observable } from 'rxjs';
import { Store } from '@ngxs/store';
import { Product } from '../../../../shared/models/product';
import { CartState } from '../../../../shared/states/cart-state';
import { Select } from '@ngxs/store';
import {
  DelAllProductsFromCart,
  DelProductFromCart,
} from '../../../../shared/actions/cart.action';
import { Subscription } from 'rxjs';
import { ProductsService } from '../../product.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss'],
})
export class CartComponent {
  subscription!: Subscription;
  product: Product = new Product();
  id!: number;

  @Select(CartState.getProductsFromCart) products$!: Observable<Product[]>;
  constructor(private store: Store, private productService: ProductsService) {}

  removeAll() {
    console.log('test');
    this.store.dispatch(new DelAllProductsFromCart());
  }
}
