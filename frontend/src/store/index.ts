import { createStore, Store, Commit } from 'vuex';
import { api } from 'boot/axios';
import { RootState, Product, Brand } from './types';

const store: Store<RootState> = createStore({
  state: {
    products: [],
    brands: [],
  },
  mutations: {
    setProducts(state: RootState, products: Product[]) {
      state.products = products;
    },
    setBrands(state: RootState, brands: Brand[]) {
      state.brands = brands;
    },
    addProduct(state: RootState, product: Product) {
      state.products.push(product);
    },
    updateProduct(state: RootState, updatedProduct: Product) {
      const index = state.products.findIndex((p) => p.id === updatedProduct.id);
      if (index !== -1) {
        state.products.splice(index, 1, updatedProduct);
      }
    },
    deleteProduct(state: RootState, productId: string) {
      const index = state.products.findIndex((p) => p.id === productId);
      if (index !== -1) {
        state.products.splice(index, 1);
      }
    },
  },
  actions: {
    async fetchProducts({ commit }: { commit: Commit }) {
      try {
        const { data } = await api.get('products');
        commit('setProducts', data.data);
      } catch (error) {
        throw new Error(error);
      }
    },
    async fetchBrands({ commit }: { commit: Commit }) {
      try {
        const { data } = await api.get('brands');
        commit('setBrands', data.data);
      } catch (error) {
        throw new Error(error);
      }
    },
    async createProduct({ commit }: { commit: Commit }, product: Product) {
      try {
        const createdProduct: Product = await api.post('products/store', product);
        commit('addProduct', createdProduct);
      } catch (error) {
        throw new Error(error);
      }
    },
    async updateProduct({ commit }: { commit: Commit }, product: Product) {
      try {
        const updatedProduct: Product = await api.post(`products/${product.id}`, product);
        commit('updateProduct', updatedProduct);
      } catch (error) {
        throw new Error(error);
      }
    },
    async deleteProduct({ commit }: { commit: Commit }, productId: number) {
      try {
        await api.delete(`products/${productId}`);
        commit('deleteProduct', productId);
      } catch (error) {
        throw new Error(error);
      }
    },
  },
});

export default store;
