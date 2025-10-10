<template>

    <Head title="Administrar Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Administrar Usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <v-card>
                    <v-card-title>
                        Usuarios
                        <v-spacer></v-spacer>
                        <v-text-field v-model="search" append-inner-icon="mdi-magnify" label="Buscar" single-line
                            hide-details variant="solo"></v-text-field>
                    </v-card-title>

                    <v-data-table :headers="headers" :items="users" :search="search">
                        <template v-slot:item.roles="{ item }">
                            <v-chip v-for="role in item.roles" :key="role.id" color="primary" dark>
                                {{ role.name }}
                            </v-chip>
                        </template>

                        <template v-slot:item.actions="{ item }">
                            <v-icon small class="mr-2" @click="editItem(item)">
                                mdi-pencil
                            </v-icon>
                            <v-icon small @click="resetPassword(item)">
                                mdi-lock-reset
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-card>
            </div>
        </div>

        <!-- Dialogo para editar usuario -->
        <v-dialog v-model="dialog" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="text-h6">Editar Usuario</span>
                </v-card-title>

                <v-card-text>
                    <v-text-field v-model="editedItem.name" label="Nombre" variant="solo" readonly></v-text-field>
                    <v-text-field v-model="editedItem.email" label="Email" variant="solo" readonly></v-text-field>
                    <v-text-field v-model="editedItem.telefono" label="Teléfono" variant="solo"></v-text-field>

                    <v-select v-model="editedItem.roles" :items="allRoles" item-title="name" item-value="id"
                        label="Roles" variant="solo" multiple chips closable-chips />

                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="closeDialog">Cancelar</v-btn>
                    <v-btn color="success" @click="saveEdit">Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Dialogo para resetear contraseña -->
        <v-dialog v-model="resetDialog" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="text-h6">Resetear Contraseña</span>
                </v-card-title>
                <v-card-text>
                    <p class="mb-4">¿Estás seguro de que deseas resetear la contraseña para el usuario?</p>
                    <v-text-field :model-value="itemToReset?.name" label="Nombre" variant="solo"
                        readonly></v-text-field>
                    <v-text-field :model-value="itemToReset?.email" label="Email" variant="solo"
                        readonly></v-text-field>
                    <p>Se generará una nueva contraseña aleatoria y se le enviará por correo electrónico.</p>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="closeResetDialog">Cancelar</v-btn>
                    <v-btn color="error" @click="confirmResetPassword" :loading="isResetting">Reset Password</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    users: Array,
    roles: Array, // Roles disponibles para asignar
})

// Estado
const search = ref('')
const dialog = ref(false)
const resetDialog = ref(false)
const itemToReset = ref(null)
const allRoles = ref(props.roles) // aquí cargo los roles de Spatie
const isResetting = ref(false)

// Usamos useForm para manejar el estado del formulario y el envío
const editedItem = useForm({
    id: null,
    name: '',
    email: '',
    telefono: '',
    roles: [], // Usamos un array para los roles
})

const headers = ref([
    { title: 'Nombre', key: 'name' },
    { title: 'Email', key: 'email' },
    { title: 'Roles', key: 'roles', value: 'roles' }, // Añadimos 'value' para que funcione el ordenamiento
    { title: 'Acciones', key: 'actions', sortable: false },
])

// Funciones
const editItem = (item) => {
    editedItem.id = item.id;
    editedItem.name = item.name;
    editedItem.email = item.email;
    editedItem.telefono = item.telefono;
    // Mapeamos los roles del usuario a un array de IDs para el v-select
    editedItem.roles = item.roles.map(role => role.id);
    dialog.value = true
}

const closeDialog = () => {
    dialog.value = false
    editedItem.reset(); // Limpiamos el formulario al cerrar
}

const saveEdit = () => {
    // Aquí envías los datos al backend con Inertia
    editedItem.put(route('users.update', editedItem.id), {
        onSuccess: () => closeDialog(), // Cierra el diálogo solo si la petición es exitosa
        // Opcional: manejo de errores
        onError: (errors) => console.error('Error al guardar:', errors),
    });
}

const closeResetDialog = () => {
    resetDialog.value = false
    itemToReset.value = null
    isResetting.value = false
}

const resetPassword = (item) => {
    itemToReset.value = item
    resetDialog.value = true
}

const confirmResetPassword = () => {
    if (!itemToReset.value) return;
    isResetting.value = true;
    router.post(route('users.reset-password', itemToReset.value.id), {}, {
        onSuccess: () => {
            closeResetDialog();
        },
        onFinish: () => { isResetting.value = false; }
    });
}
</script>
