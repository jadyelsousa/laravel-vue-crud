<!-- eslint-disable max-len -->
<template>
  <div class="q-pa-md">
    <q-table title="Produtos" :rows="products" :columns="columns" row-key="name" :loading="loading">
      <template v-slot:top>
        <q-space />
        <q-btn color="primary" label="Novo Produto" :to="{ name: 'formUser' }" />
      </template>
      <template v-slot:body-cell-brand="props">
        <q-td :props="props" class="q-gutter-sm">
          {{ props.row.brand.name }}
        </q-td>
      </template>
      <template v-slot:body-cell-actions="props">
        <q-td :props="props" class="q-gutter-sm">
          <q-btn icon="edit" color="info" dense size="sm" @click="handleEditUser(props.row.id)" />
          <q-btn icon="delete" color="negative" dense size="sm" @click="handleDeleteUser(props.row.id)" />
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script>
import {
  defineComponent, onMounted, ref, computed,
}
  from 'vue';
import { Loading, useQuasar } from 'quasar';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default defineComponent({
  name: 'IndexPage',
  setup() {
    const $q = useQuasar();
    const loading = ref(true);
    const router = useRouter();
    const store = useStore();
    const products = computed(() => store.state.products);
    const columns = [
      {
        name: 'id', field: 'id', label: 'Id', sortable: true, align: 'left',
      }, {
        name: 'nome', field: 'name', label: 'Nome', sortable: true, align: 'left',
      }, {
        name: 'descricao', field: 'description', label: 'Descrição', sortable: true, align: 'left',
      }, {
        name: 'voltage', field: 'voltage', label: 'Tensão', sortable: true, align: 'left',
      }, {
        name: 'brand', field: 'brand', label: 'Marca', sortable: true, align: 'left',
      }, {
        name: 'material', field: 'material', label: 'Material', sortable: true, align: 'left',
      }, {
        name: 'department', field: 'department', label: 'Departamento', sortable: true, align: 'left',
      }, {
        name: 'price', field: 'price', label: 'Preço', align: 'left',
      }, {
        name: 'actions', field: 'actions', label: 'Ações', align: 'right',
      },
    ];
    const getProducts = async () => {
      try {
        await store.dispatch('fetchProducts');
        loading.value = false;
      } catch (error) {
        throw new Error(error);
      }
    };
    // eslint-disable-next-line consistent-return
    const handleEditUser = async (id) => {
      router.push({ name: 'formUser', params: { id } });
    };
    const handleDeleteUser = async (id) => {
      try {
        $q.dialog({
          dark: true,
          title: 'Confirmar exclusão',
          message: 'Tem certeza que deseja excluir esse produto?',
          cancel: true,
          persistent: true,
        }).onOk(async () => {
          await store.dispatch('deleteProduct', id);
          $q.notify({ message: 'Produto excluído', icon: 'check', color: 'positive' });
          await getProducts();
        });
      } catch (error) {
        $q.notify({ message: 'Erro ao excluir produto', icon: 'times', color: 'negative' });
      }
    };

    onMounted(() => {
      getProducts();
    });

    return {
      columns,
      products,
      loading,
      handleDeleteUser,
      handleEditUser,
    };
  },
});

</script>
