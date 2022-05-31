import { Injectable } from '@angular/core';
import { Action, Selector, State, StateContext } from '@ngxs/store';
import {
  AddAddress,
  DelAddress,
  DelAllAddresses,
} from 'shared/actions/address.action';
import { Address } from 'shared/models/address';
import { AddressStateModel } from './address-state-model';

@State<AddressStateModel>({
  name: 'addresses',
  defaults: {
    addresses: [],
  },
})
@Injectable()
export class AddressState {
  @Selector()
  static getAddressesLength(state: AddressStateModel): number {
    return state.addresses.length;
  }

  @Selector()
  static getAddresses(state: AddressStateModel): Address[] {
    return state.addresses;
  }

  @Action(DelAllAddresses)
  removeAll({ getState, patchState }: StateContext<AddressStateModel>) {
    const state = getState();

    patchState({
      addresses: [],
    });
  }

  @Action(AddAddress)
  add(
    { getState, patchState }: StateContext<AddressStateModel>,
    { payload }: AddAddress
  ) {
    const state = getState();
    console.log('test');
    patchState({
      addresses: [...state.addresses, payload],
    });
  }
}
