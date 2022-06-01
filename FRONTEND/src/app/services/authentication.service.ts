import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { User } from 'shared/models/User';
import { map } from 'rxjs/operators';
import { ApiHttpInterceptor } from '../interceptors/api-http.interceptor';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  urlApiLogin: string = '/api/login';
  urlApiSignup: string = '/api/signup';

  private currentUserSubject!: BehaviorSubject<User>;
  public currentUser!: Observable<User>;

  constructor(private http: HttpClient) {
    let user: User = JSON.parse(localStorage.getItem('currentUser')!);
    ApiHttpInterceptor.jwtToken = JSON.parse(localStorage.getItem('jwttoken')!);
    if (user == null || user.expiration_time < Math.floor(Date.now() / 1000)) {
      this.currentUserSubject = new BehaviorSubject<User>(null!);
      localStorage.removeItem('currentUser');
      localStorage.removeItem('jwttoken');
    } else {
      this.currentUserSubject = new BehaviorSubject<User>(user);
    }
    this.currentUser = this.currentUserSubject.asObservable();
  }

  public logout() {
    localStorage.removeItem('currentUser');
    localStorage.removeItem('jwttoken');
    this.currentUserSubject.next(null!);
  }

  public postLogin(email: string, password: string): Observable<User> {
    let data: string = 'email=' + email + '&password=' + password;
    let httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/x-www-form-urlencoded',
      }),
    };
    return this.http.post<User>(this.urlApiLogin, data, httpOptions).pipe(
      map((user) => {
        localStorage.setItem('currentUser', JSON.stringify(user));
        localStorage.setItem(
          'jwttoken',
          JSON.stringify(ApiHttpInterceptor.jwtToken)
        );
        this.currentUserSubject.next(user);
        return user;
      })
    );
  }

  public postSignup(
    email: string,
    password: string,
    prenom: string,
    nom: string
  ): Observable<User> {
    let data: string =
      'email=' +
      email +
      '&password=' +
      password +
      '&prenom=' +
      prenom +
      '&nom=' +
      nom +
      '&email=' +
      email;
    let httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/x-www-form-urlencoded',
      }),
    };
    return this.http.post<User>(this.urlApiSignup, data, httpOptions);
  }
}
