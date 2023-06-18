import { boot } from 'quasar/wrappers';
import { createStore } from 'vuex';
import storeConfig from '../store/index';

export default boot(({ app }) => {
  const store = createStore(storeConfig);
  app.use(store);

  app.config.globalProperties.$store = store;
});

// for use outside of a Vue component
export const store = createStore(storeConfig);
