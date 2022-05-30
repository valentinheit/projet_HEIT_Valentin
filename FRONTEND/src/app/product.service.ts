import { Injectable } from '@angular/core';
import { Product } from './product';
import { Observable, of } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { environment } from '../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ProductsService {
  constructor(private httpClient: HttpClient) {}
  public getCatalogue(): Observable<Product[]> {
    return this.httpClient.get<Product[]>(environment.baseUrl);
  }
}
