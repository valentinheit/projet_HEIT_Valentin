import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor,
  HttpResponse,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';

@Injectable()
export class ApiHttpInterceptor implements HttpInterceptor {
  public static jwtToken: String = '';

  constructor() {}

  intercept(
    request: HttpRequest<unknown>,
    next: HttpHandler
  ): Observable<HttpEvent<unknown>> {
    if (ApiHttpInterceptor.jwtToken !== '') {
      request = request.clone({
        setHeaders: { Authorization: `Bearer ${ApiHttpInterceptor.jwtToken}` },
      });
    }

    return next.handle(request).pipe(
      tap((evt: HttpEvent<any>) => {
        if (evt instanceof HttpResponse) {
          let tab: Array<String>;
          let headerAuthorization = evt.headers.get('Authorization');
          if (headerAuthorization != null) {
            tab = headerAuthorization.split(/Bearer\s+(.*)$/i);
            if (tab.length > 1) ApiHttpInterceptor.jwtToken = tab[1];
          }
        }
      })
    );
  }
}
