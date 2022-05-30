import { Address } from '../models/address';

export class AddAddress {
  static readonly type = '[Address] Add';
  constructor(public payload: Address) {}
}

export class DelAddress {
  static readonly type = '[Address] Del';

  constructor(public payload: Address) {}
}

export class DelAllAddresses {
  static readonly type = '[Address] DelAll';

  constructor() {}
}
