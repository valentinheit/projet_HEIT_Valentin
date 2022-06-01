import { Component, OnInit, Input } from '@angular/core';
import { NgForm, ValidatorFn, FormBuilder } from '@angular/forms';
import {
  FormGroup,
  FormControl,
  Validators,
  AbstractControl,
  ValidationErrors,
} from '@angular/forms';
import { Router } from '@angular/router';
import { AuthenticationService } from 'src/app/services/authentication.service';

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.scss'],
})
export class SigninComponent implements OnInit {
  form: FormGroup = new FormGroup({});
  valid: boolean = true;
  submitted: boolean = false;
  errorMsg!: string;
  email = new FormControl('', [Validators.required, Validators.email]);
  password = new FormControl('', [Validators.required]);
  constructor(
    private formBuilder: FormBuilder,
    private authenticationService: AuthenticationService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.form = new FormGroup({
      email: this.email,
      password: this.password,
    });
  }

  isValid() {
    return this.isValid;
  }

  onSubmit(): void {
    if (this.form.valid) {
      this.authenticationService
        .postLogin(this.email?.value, this.password?.value)
        .subscribe(
          (data) => {
            this.router.navigate(['/']);
          },
          (errorResponse) => {
            if (errorResponse['status'] == 404) {
              this.errorMsg = "Oulala, il n'y a pas cette URL";
            } else {
              this.errorMsg = errorResponse['error']['error'];
            }
          }
        );
    } else {
      Object.keys(this.form.controls).forEach((field) => {
        const control = this.form.get(field);
        control?.markAsTouched({ onlySelf: true });
      });
    }
  }
}
