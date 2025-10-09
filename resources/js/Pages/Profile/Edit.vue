<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import UpdateProfilePic from './Partials/UpdateProfilePic.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});
</script>

<template>

  <Head title="Perfil" />

  <AuthenticatedLayout id="dashboard-page">
    <v-container class="my-10 ">
      <v-row justify="center">
        <v-col cols="12" md="10" lg="8">
          <!-- Card principal -->
          <v-card elevation="4" rounded="xl" class="pa-6">
            <v-card-title class="d-flex justify-center text-h5 font-weight-bold mb-6">
              Perfil de Usuario   
            </v-card-title>


            <!-- Foto de perfil -->
            <v-row justify="center" align="center" class="mb-8">
              <v-col cols="12" sm="6" md="4" class="text-center">
                <v-avatar size="160" class="elevation-4">
                  <UpdateProfilePic />
                </v-avatar>
              </v-col>
            </v-row>

            <!-- Información del perfil -->
            <v-row justify="center" class="mb-6">
              <v-col cols="12" md="8">
                <v-card elevation="2" rounded="xl">
                  <v-card-title class="d-flex justify-center text-h6 font-weight-bold">
                    Información del Perfil
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-card-text>
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>

            <!-- Cambiar contraseña -->
            <v-row justify="center" class="mb-6">
              <v-col cols="12" md="8">
                <v-card elevation="2" rounded="xl">
                  <v-card-title class="d-flex justify-center text-h6 font-weight-bold">
                    Cambiar Contraseña
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-card-text>
                    <UpdatePasswordForm />
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>

            <!-- Eliminar usuario (opcional) -->
            <!--
            <v-row justify="center">
              <v-col cols="12" md="8">
                <v-card elevation="2" rounded="xl" color="red-lighten-5">
                  <v-card-title class="text-h6 font-weight-bold text-red-darken-2">
                    Eliminar Cuenta
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-card-text>
                    <DeleteUserForm />
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
            -->

          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </AuthenticatedLayout>
</template>

<style>
 #dashboard-page .v-main{
  background-color: #3c4557;
 }
</style>
