import { Component, OnInit, Input } from '@angular/core';
import { NgForm, ValidatorFn, FormBuilder } from '@angular/forms';
import {
  FormGroup,
  FormControl,
  Validators,
  AbstractControl,
  ValidationErrors,
} from '@angular/forms';

@Component({
  selector: 'app-saisie-client',
  templateUrl: './saisie-client.component.html',
  styleUrls: ['./saisie-client.component.scss'],
})
export class SaisieClientComponent implements OnInit {
  form: FormGroup = new FormGroup({});
  valid: boolean = true;
  submitted: boolean = false;
  nom = new FormControl('', [Validators.required]);
  prenom = new FormControl('', [Validators.required]);
  adresse = new FormControl('');
  cp = new FormControl('');
  ville = new FormControl('');
  tel = new FormControl('', [
    Validators.required,
    Validators.minLength(10),
    Validators.maxLength(10),
  ]);
  email = new FormControl('', [Validators.required, Validators.email]);
  civilite = new FormControl('');
  login = new FormControl('', [Validators.required]);
  password = new FormControl('', [Validators.required]);
  confirmPassword = new FormControl('', [
    Validators.required,
    this.isSamePasswords(),
  ]);

  pays = new FormControl('');

  constructor(private formBuilder: FormBuilder) {}

  ngOnInit(): void {
    this.form = new FormGroup({
      nom: this.nom,
      prenom: this.prenom,
      adresse: this.adresse,
      cp: this.cp,
      ville: this.ville,
      tel: this.tel,
      email: this.email,
      civilite: this.civilite,
      login: this.login,
      password: this.password,
      confirmPassword: this.confirmPassword,
      pays: this.pays,
    });
  }

  isValid() {
    return this.isValid;
  }

  showRecap() {
    if (
      this.form.get('nom') &&
      this.form.get('prenom') &&
      this.form.get('email') &&
      this.form.get('login') &&
      this.form.get('password') &&
      this.form.get('confirmPassword')
    ) {
      this.submitted = true;
    }
  }

  isSamePasswords(): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      return this.form.get('password')?.value ===
        this.form.get('confirmPassword')?.value
        ? null
        : { PasswordsNotCorresponding: true };
    };
  }
}
