import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse, HttpRequest, HttpParameterCodec, HttpParams  } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs';
import { filter } from 'rxjs';
import { UserLogin } from '../models/user-login';
import { UserRegister } from '../models/user-register';

const httpOptions ={
  headers:new HttpHeaders({'Content-Type':'Application/json'})
}
@Injectable({
  providedIn: 'root'
})

export class HomepageService {
  apiUrl = 'http://localhost:8000/api/auth';

  constructor(private http: HttpClient) { }

  loginResponse(body?: UserLogin): Observable<HttpResponse<any>> {
    let __headers = new HttpHeaders();
    let __body: any = null;
    __body = body;
    let req = new HttpRequest<any>(
      "Post",
      this.apiUrl + `/login`,
      __body,
      {
        headers: __headers,
        // params: new HttpParams().set('program_id', 'test'),
        responseType: 'json'
      });

    return this.http.request<any>(req).pipe(
      filter(_r => _r instanceof HttpResponse),
      map(_r => {
        let _resp = _r as HttpResponse<any>;
        let _body: any = null;
        _body = _resp.body as any
        return _resp.clone({body: _body}) as HttpResponse<any>;
      })
    );
  }

  login(body?: UserLogin): Observable<any> {
    return this.loginResponse(body).pipe(
      map(_r => _r.body)
    );
  }

  registerResponse(body?: UserRegister): Observable<HttpResponse<any>> {
    let __headers = new HttpHeaders();
    let __body: any = null;
    __body = body;
    let req = new HttpRequest<any>(
      "Post",
      this.apiUrl + `/register`,
      __body,
      {
        headers: __headers,
        // params: new HttpParams().set('program_id', 'test'),
        responseType: 'json'
      });

    return this.http.request<any>(req).pipe(
      filter(_r => _r instanceof HttpResponse),
      map(_r => {
        let _resp = _r as HttpResponse<any>;
        let _body: any = null;
        _body = _resp.body as any
        return _resp.clone({body: _body}) as HttpResponse<any>;
      })
    );
  }

  register(body?: UserRegister): Observable<any> {
    return this.registerResponse(body).pipe(
      map(_r => _r.body)
    );
  }

  testReponse(body?: UserRegister): Observable<HttpResponse<any>> {
    let __headers = new HttpHeaders();
    let __body: any = null;
    __body = body;
    let req = new HttpRequest<any>(
      "Get",
      this.apiUrl + `/test`,
      __body,
      {
        headers: __headers,
        // params: new HttpParams().set('program_id', 'test'),
        responseType: 'json'
      });

    return this.http.request<any>(req).pipe(
      filter(_r => _r instanceof HttpResponse),
      map(_r => {
        let _resp = _r as HttpResponse<any>;
        let _body: any = null;
        _body = _resp.body as any
        return _resp.clone({body: _body}) as HttpResponse<any>;
      })
    );
  }

  test(): Observable<any> {
    return this.testReponse().pipe(
      map(_r => _r.body)
    );
  }
}
