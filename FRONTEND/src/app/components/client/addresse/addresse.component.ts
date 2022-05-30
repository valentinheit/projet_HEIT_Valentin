import { Component, Input } from '@angular/core';
import { Select, Store } from '@ngxs/store';
import { Observable } from 'rxjs';

import { AddAddress, DelAddress } from 'shared/actions/address.action';
import { Address } from 'shared/models/address';
import { AddressState } from 'shared/states/address-state';
import { FormControl, Validators, FormBuilder } from '@angular/forms';

@Component({
  selector: 'app-addresse',
  templateUrl: './addresse.component.html',
  styleUrls: ['./addresse.component.scss'],
})
export class AddresseComponent {
  valid: boolean = true;
  submitted: boolean = false;
  cp = new FormControl('');
  city = new FormControl('');
  country = new FormControl('');
  street = new FormControl('');
  addressForm: any;
  @Select(AddressState.getAddresses) addresses$!: Observable<Address[]>;
  constructor(private formBuilder: FormBuilder, private store: Store) {
    this.addressForm = this.formBuilder.group({
      street: ['', Validators.required],
      cp: ['', Validators.required],
      city: ['', Validators.required],
      country: ['', Validators.required],
    });
  }

  addAddress() {
    let newAddr = new Address();
    newAddr.city = this.addressForm.value.city;
    newAddr.country = this.addressForm.value.country;
    newAddr.street = this.addressForm.value.street;
    newAddr.cp = this.addressForm.value.cp;
    console.log(newAddr);
    this.store.dispatch(new AddAddress(newAddr));
  }
}
