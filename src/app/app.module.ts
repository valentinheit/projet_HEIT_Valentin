import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { SaisieClientComponent } from './components/client/saisie-client/saisie-client.component';
import { AddresseComponent } from './components/client/addresse/addresse.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { RecapitulatifComponent } from './components/client/recapitulatif/recapitulatif.component';
import { PhoneFormatPipe } from './phone-format.pipe';
import { ProductsService } from './product.service';
import { CatalogueComponent } from './components/catalogue/catalogue.component';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { SearcherComponent } from './components/searcher/searcher.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { RouterModule, Routes } from '@angular/router';
import { NgxsModule } from '@ngxs/store';
import { ClientModule } from './components/client/client.module';
import { CartComponent } from './components/cart/cart.component';
import { CartState } from 'shared/states/cart-state';
import { NotFoundComponent } from './components/not-found/not-found.component';
import { ProductDetailsComponent } from './components/product-details/product-details.component';
import { AddressState } from 'shared/states/address-state';
const appRoutes: Routes = [
  { path: 'product/details/:id', component: ProductDetailsComponent },
  { path: '', component: AppComponent },
  { path: 'catalogue', component: CatalogueComponent },
  { path: 'cart', component: CartComponent },
  {
    path: 'client',
    loadChildren: () =>
      import('./components/client/client.module').then((m) => m.ClientModule),
  },
  { path: 'not_found', component: NotFoundComponent },
  { path: '**', redirectTo: 'not_found' },
];
@NgModule({
  declarations: [
    AppComponent,
    SaisieClientComponent,
    AddresseComponent,
    HeaderComponent,
    FooterComponent,
    RecapitulatifComponent,
    PhoneFormatPipe,
    CatalogueComponent,
    SearcherComponent,
    CartComponent,
    NotFoundComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    FontAwesomeModule,
    RouterModule.forRoot(appRoutes),
    NgxsModule.forRoot([CartState, AddressState]),
    ClientModule,
  ],
  exports: [RouterModule],
  providers: [ProductsService],
  bootstrap: [AppComponent],
})
export class AppModule {}
