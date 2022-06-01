import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { Product } from 'shared/models/product';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ProductsService {
  urlApiProducts: string = '/api/products';
  productsObs$!: Subject<Array<Product>>;
  allProducts!: Array<Product>;
  products!: Array<Product>;

  constructor(private http: HttpClient) {}

  public getProductsObs(): Subject<Array<Product>> {
    this.getProductsIfEmpty();
    return this.productsObs$;
  }

  public getProducts(): Array<Product> {
    this.getProductsIfEmpty();
    return this.products;
  }

  public setProductsFilter(data: any): void {
    this.products = this.allProducts.slice();
    this.emitProductSubject();
  }

  private getProductsIfEmpty(): void {
    if (this.productsObs$ == null) {
      this.productsObs$ = new Subject<Array<Product>>();
      this.http
        .get<Array<Product>>(this.urlApiProducts)
        .subscribe((products) => {
          this.products = products;
          this.allProducts = products;
          this.emitProductSubject();
        });
    }
    this.emitProductSubject();
  }

  private emitProductSubject() {
    if (this.products != null) {
      this.productsObs$.next(this.products.slice());
    }
  }
}
