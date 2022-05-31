import { Product } from '../models/product';

export class AddProductToCart {
  static readonly type = '[Product] Add';
  constructor(public payload: Product) {}
}

export class DelProductFromCart {
  static readonly type = '[Product] Del';

  constructor(public payload: Product) {}
}

export class DelAllProductsFromCart {
  static readonly type = '[Product] DelAll';

  constructor() {}
}
