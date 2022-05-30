import { Injectable } from '@angular/core';
import { NgxsModule, Action, Selector, State, StateContext } from '@ngxs/store';
import { CartStateModel } from './cart-state-model';
import {
  AddProductToCart,
  DelProductFromCart,
  DelAllProductsFromCart,
} from '../actions/cart.action';
import { Cart } from '../models/cart';
import { Product } from '../models/product';
import { Guid } from 'guid-typescript';

@State<CartStateModel>({
  name: 'products',
  defaults: {
    products: [],
  },
})
@Injectable()
export class CartState {
  @Selector()
  static getProductsNb(state: CartStateModel): number {
    return state.products.length;
  }

  @Selector()
  static getProductsFromCart(state: CartStateModel): Product[] {
    return state.products;
  }

  @Action(AddProductToCart)
  add(
    { getState, patchState }: StateContext<CartStateModel>,
    { payload }: AddProductToCart
  ) {
    const state = getState();
    state.products.forEach((p) => {
      if (p.id === payload.id) {
      }
    });

    patchState({
      products: [...state.products, payload],
    });
  }

  @Action(DelProductFromCart)
  del(
    { getState, patchState }: StateContext<CartStateModel>,
    { payload }: DelProductFromCart
  ) {
    const state = getState();
    patchState({
      products: [...state.products.filter((t) => t.id != payload.id)],
    });
  }

  @Action(DelAllProductsFromCart)
  delAll(
    { getState, patchState }: StateContext<CartStateModel>,
    { payload }: DelProductFromCart
  ) {
    const state = getState();
    patchState({
      products: [],
    });
  }
}
