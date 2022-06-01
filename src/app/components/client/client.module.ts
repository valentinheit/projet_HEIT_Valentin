import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { SaisieClientComponent } from './saisie-client/saisie-client.component';
import { AddresseComponent } from './addresse/addresse.component';
import { SigninComponent } from './signin/signin.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

const routes: Routes = [
  { path: 'signup', component: SaisieClientComponent },
  { path: 'addresses', component: AddresseComponent },
  { path: 'login', component: SigninComponent },
];
@NgModule({
  declarations: [SigninComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    FormsModule,
    ReactiveFormsModule,
  ],
})
export class ClientModule {}
