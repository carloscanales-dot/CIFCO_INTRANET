<template>
    <Head title="Administrar Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Administrar Usuarios</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <v-card>
                    <v-card-title>
                        Usuarios
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Buscar"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="users"
                        :search="search"
                    >
                        <template v-slot:item.roles="{ item }">
                            <v-chip v-for="role in item.roles" :key="role.id" color="primary" dark>{{ role.name }}</v-chip>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                            <v-icon
                                small
                                @click="resetPassword(item)"
                            >
                                mdi-lock-reset
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    users: Array,
});

const search = ref('');
const headers = ref([
    { title: 'Nombre', key: 'name' },
    { title: 'Email', key: 'email' },
    { title: 'Roles', key: 'roles' },
    { title: 'Acciones', key: 'actions', sortable: false },
]);

const editItem = (item) => {
    // Logic to edit user
    console.log('Edit item', item);
};

const resetPassword = (item) => {
    // Logic to reset password
    console.log('Reset password for', item);
};

</script>
