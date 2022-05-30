import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Store } from '@ngxs/store';
import { Subscription } from 'rxjs';
import { Product } from 'shared/models/product';
import { ProductsService } from '../../product.service';
import { AddProductToCart } from 'shared/actions/cart.action';
@Component({
  selector: 'app-product-details',
  templateUrl: './product-details.component.html',
  styleUrls: ['./product-details.component.scss'],
})
export class ProductDetailsComponent {
  id!: string;
  product: Product = new Product();
  subscription!: Subscription;

  constructor(
    private route: ActivatedRoute,
    private productService: ProductsService,
    private store: Store
  ) {
    this.id = this.route.snapshot.params['id'];
    this.subscription = this.productService
      .getCatalogue()
      .subscribe((catalogue: Product[]) => {
        const selectedProduct = catalogue.find((p) => {
          return p.id == this.id;
        });
        console.log(selectedProduct);
        if (selectedProduct) this.product = selectedProduct;
      });
  }
  addToCart(product: Product) {
    this.store.dispatch(new AddProductToCart(product));
  }
}
