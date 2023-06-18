<!-- eslint-disable max-len -->
<template>
  <q-page padding>
    <q-form @submit="handleSubmit()" class="row q-col-gutter-sm">
      <q-input filled v-model="form.name" label="Nome *" lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" type="text" />
      <q-input filled v-model="form.description" label="Descrição *" lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" type="text" />
      <q-input filled v-model="form.voltage" label="Tensão *" lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" type="text" />
      <q-input filled v-model="form.material" label="Material *" lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" type="text" />
      <q-select outlined v-model="form.brand_id" :options="brands" emit-value map-options option-value="id" option-label="name" label="Marca" class="col-lg-6 col-xs-12" type="text" :rules="[val => !!val || 'Campo obrigatório']" />
      <q-input filled v-model="form.department" label="Departamento *" lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" type="text" />
      <q-input filled v-model="form.price" label="Preço *" mask="#.##" fill-mask="0" reverse-fill-mask lazy-rules :rules="[val => val && val.length > 0 || 'Campo obrigatório']" class="col-lg-6 col-xs-12" input-class="text-right"/>
      <q-select v-model="form.id" class="col-lg-6 col-xs-12" style="display: none;" />
      <div class="col-12 q-gutter-sm">
        <q-btn label="Salvar" type="submit" color="primary" class="float-right" icon="save" @submit="handleSubmit()" />
        <q-btn label="Cancelar" color="white" class="float-right" text-color="primary" :to="{ name: 'home' }" />
      </div>
    </q-form>
  </q-page>
</template>

<script>
import {
  defineComponent, ref, onMounted, computed,
}
  from 'vue';
import { useQuasar } from 'quasar';
import { useRouter, useRoute } from 'vue-router';
import { useStore } from 'vuex';

export default defineComponent({
  name: 'FormUser',
  setup() {
    const route = useRoute();
    const $q = useQuasar();
    const router = useRouter();
    const store = useStore();
    const brands = computed(() => store.state.brands);
    const form = ref({
      name: '',
      id: '',
      description: '',
      voltage: '',
      brand_id: '',
      material: '',
      department: '',
      price: '',
    });
    const getBrands = async () => {
      try {
        await store.dispatch('fetchBrands');
      } catch (error) {
        throw new Error(error);
      }
    };
    onMounted(async () => {
      if (route.params.id) {
        form.value = store.state.products.find((p) => p.id === Number(route.params.id));
      }
      const responseBrands = await getBrands();
      brands.value = responseBrands;
    });
    const handleSubmit = async () => {
      if (route.params.id) {
        try {
          await store.dispatch('updateProduct', form.value);
          $q.notify({ message: 'ProdutoCriado', icon: 'check', color: 'positive' });
          router.push({ name: 'home' });
        } catch (error) {
          $q.notify({ message: 'Erro ao atualizar produto', icon: 'times', color: 'negative' });
        }
      } else {
        try {
          await store.dispatch('createProduct', form.value);
          $q.notify({ message: 'ProdutoCriado', icon: 'check', color: 'positive' });
          router.push({ name: 'home' });
        } catch (error) {
          $q.notify({ message: 'Erro ao atualizar produto', icon: 'times', color: 'negative' });
        }
      }
    };

    return {
      brands,
      form,
      handleSubmit,
    };
  },
});
</script>

<style></style>
