<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const page = usePage();
const users = computed(() => (page.props && page.props.users) ? page.props.users : []);

const search = ref('');

const filtered = computed(() => {
    if (!search.value) return users.value;
    const q = search.value.toLowerCase();
    return users.value.filter(u => {
        return (u.name && u.name.toLowerCase().includes(q)) ||
            (u.area && u.area.toLowerCase().includes(q)) ||
            (u.cargo && u.cargo.toLowerCase().includes(q)) ||
            (u.email && u.email.toLowerCase().includes(q)) ||
            (u.telefono && String(u.telefono).toLowerCase().includes(q));
    });
});

const headers = [
    { title: 'Nombre', key: 'name' },
    { title: 'Área', key: 'area' },
    { title: 'Cargo', key: 'cargo' },
    { title: 'Correo', key: 'email' },
    { title: 'Teléfono', key: 'telefono' },
];
</script>

<template>
    <Head title="Directorio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Directorio</h2>
        </template>

        <v-container>
            <v-row class="mb-4">
                <v-text-field v-model="search" label="Buscar" prepend-inner-icon="mdi-magnify"/>
            </v-row>

            <v-sheet>
                <v-data-table :items="filtered" :headers="headers">
                    <template #item.name="{ item }">
                        <div class="font-medium">{{ item.name }}</div>
                    </template>
                    <template #item.area="{ item }">
                        {{ item.area || '-' }}
                    </template>
                    <template #item.cargo="{ item }">
                        {{ item.cargo || '-' }}
                    </template>
                    <template #item.email="{ item }">
                        {{ item.email || '-' }}
                    </template>
                    <template #item.telefono="{ item }">
                        {{ item.telefono || '-' }}
                    </template>
                </v-data-table>
            </v-sheet>
        </v-container>
    </AuthenticatedLayout>
</template>
