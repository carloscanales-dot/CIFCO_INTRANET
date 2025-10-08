<script setup>
import {Head} from '@inertiajs/vue3';
import {
  VApp,
  VAppBar,
  VContainer,
  VRow,
  VCol,
  VCard,
  VBtn,
  VSpacer
} from 'vuetify/components';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Head title="Construcción"/>
  <v-app
    style="background: #fff; min-height: 100vh;">
  <v-app-bar title="CIFCO" app color="primary" dark>
      <v-spacer/>
      <v-btn v-if="canLogin" href="/login" color="secondary" prepend-icon="mdi-login" variant="text">Login</v-btn>
      <v-btn v-if="canRegister" href="/register" color="secondary" prepend-icon="mdi-account" variant="text">Register</v-btn>
    </v-app-bar>
    <v-main>
        <v-container>
          <v-row align="center" justify="center">
            <v-col cols="12" md="6" class="d-flex flex-column align-center justify-center">
              <h1 class="text-center" style="color: #1976d2; font-weight: bold; font-size: 2.5rem;">
                Sistema en construcción..
              </h1>
              <v-btn href="/" color="primary" class="mt-4">
                Volver al Inicio
              </v-btn>
            </v-col>
            <v-col cols="12" md="6" class="d-flex align-center justify-center">
              <img src="/img/intro-img.svg" alt="Intro" style="max-width: 100%; height: auto;" />
            </v-col>
          </v-row>
        </v-container>
    </v-main>
  </v-app>
</template>
