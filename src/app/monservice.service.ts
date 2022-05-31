import { Injectable } from '@angular/core';
@Injectable()
export class MonService {
  constructor() {}
  count: number = 0;
  public getCatalogue(): any {
    return [
      { libelle: 'linux', prix: 19 },
      { libelle: 'windows', prix: 10 },
    ];
  }
  public postClient(): any {
    return 'POST CLIENT';
  }
  public getClient(): any {
    return 'GET CLIENT';
  }
  public postLogin(): any {
    return 'POST LOGIN';
  }

  public getCount(): Number {
    this.count++;
    return this.count;
  }
}
