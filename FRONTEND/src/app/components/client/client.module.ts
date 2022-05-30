import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { SaisieClientComponent } from './saisie-client/saisie-client.component';
import { AddresseComponent } from './addresse/addresse.component';

const routes: Routes = [
  { path: 'saisieClient', component: SaisieClientComponent },
  { path: 'addresses', component: AddresseComponent },
];
@NgModule({
  declarations: [],
  imports: [CommonModule, RouterModule.forChild(routes)],
})
export class ClientModule {}
