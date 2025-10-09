<template>
    <Head title="Administrar" />

    <AuthenticatedLayout id="identification-page">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">Panel de Administración</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <v-container>
                    <v-row>
                        <v-col v-if="$page.props.auth.roles.includes('Administrador')" cols="12" md="6">
                            <v-card class="mx-auto" max-width="344" @click="goTo('admin.user.management')">
                                <v-card-item>
                                    <div>
                                        <div class="text-overline mb-1">
                                            <v-icon>mdi-account-group</v-icon>
                                        </div>
                                        <div class="text-h6 mb-1">
                                            Administrar Usuarios
                                        </div>
                                        <div class="text-caption">Crear, editar, y modificar roles de usuarios. También puede restablecer las contraseñas de los usuarios.</div>
                                    </div>
                                </v-card-item>
                            </v-card>
                        </v-col>

                        <v-col v-if="$page.props.auth.roles.includes('Administrador')" cols="12" md="6">
                            <v-card class="mx-auto" max-width="344" @click="goTo('admin.asignacion.equipo')">
                                <v-card-item>
                                    <div>
                                        <div class="text-overline mb-1">
                                            <v-icon>mdi-laptop-account</v-icon>
                                        </div>
                                        <div class="text-h6 mb-1">
                                            Asignación de Equipo
                                        </div>
                                        <div class="text-caption">Asignar equipo de computo a los usuarios. (En construcción)</div>
                                    </div>
                                </v-card-item>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const goTo = (routeName) => {
    router.visit(route(routeName));
};
</script>

<style>
#identification-page .v-main {
    position: relative;
    background-color: #3c4557;
}
</style>
