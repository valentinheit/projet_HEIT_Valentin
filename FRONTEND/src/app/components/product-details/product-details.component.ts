import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Store } from '@ngxs/store';
import { Subscription } from 'rxjs';
import { Product } from 'shared/models/product';
import { ProductsService } from 'src/app/services/products.service';
import { AddProductToCart } from 'shared/actions/cart.action';
@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.scss'],
})
export class ProductDetailsComponent {
  id!: string;
  product!: Product;

  constructor(
    private route: ActivatedRoute,
    private productService: ProductsService,
    private store: Store
  ) {
    this.id = this.route.snapshot.params['id'];
    let productsTemp = this.productService
      .getProducts()
      .filter((product) => product.id == this.id);
    if (productsTemp.length > 0) this.product = productsTemp[0];
  }
  addToCart(product: Product) {
    this.store.dispatch(new AddProductToCart(product));
  }
}
